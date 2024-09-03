<?php

namespace Modules\Api\Repositories;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Laka\Core\Repositories\CoreRepository;
use Modules\Api\Entities\Tools\ConfigsModel;
use Modules\Api\Entities\Tools\ServersModel;
use Modules\Api\Helpers\ManagerHelpers;
use Modules\Api\Repositories\Formatters\DefaultFormatter;
use Symfony\Component\Process\Process;

abstract class BaseCoreRepository extends CoreRepository
{
    protected $formatters;
    protected $errorFormatters;

    public function execCmd($name, $path, $params = [], $options = null, $type = 'util')
    {
        // $func = config("api.list_util.{$name}");
        $func = ConfigsModel::firstWhere(['type' => $type, 'key' => $name]);
        $cfgPath = $func->config_path()->whereHas('osys', function($query) {
            return $query->where('name', PHP_OS);
        })->first();
        $execPath = data_get($cfgPath, 'path');
        $script = data_get($func, 'value.script');
        if (!blank($script)) {
            // if (str_contains($script, 'artisan')) {
                $cfgParams = array_keys(data_get($func, 'value.params', []));
                $artisan = str_replace($cfgParams, value($params), $script);
                $force = data_get($options, 'force', false);
                if ($force) {
                    $artisan = str_replace('--delete', '-D', $artisan);
                }
                return $this->executeCmd($execPath.$artisan, $path, $name);
            // }
        } else {
            $methodName = data_get($func, 'func');
            if (!blank($methodName)) {
                return call_user_func([$this, $methodName], $params);
            }
        }
    }

    public function execFunc($name, $params = [])
    {
        // $func = config("api.list_func.{$name}");
        $func = ConfigsModel::firstWhere(['type' => 'func', 'key' => $name]);
        $methodName = data_get($func, 'value.func');
        if (!blank($methodName)) {
            return call_user_func([$this, $methodName], $params);
        }
    }

    public function executeCmd($command, $directory, $name = null)
    {
        try {
            $process = Process::fromShellCommandline($command, $directory);
            $process->mustRun();
            $result = $process->getOutput();

            return $this->parserResultData($result, $name);
        } catch (\Exception $ex) {
            return $this->parserErrorData($ex->getMessage(), $name);
        }
    }

    public function execServices($name, $params = [])
    {
        return $this->execCmd($name, '', $params, null, 'service');
    }

    protected function parserResultData($result, $name = null)
    {
        if (!is_null($this->formatters)) {
            $listFormatter = array_wrap(data_get($this->formatters, $name, DefaultFormatter::class));

            return app(Pipeline::class)
                ->send($result)
                ->through($listFormatter)
                ->thenReturn();
        }
        return $result;
    }

    protected function parserErrorData($error, $name = null)
    {
        if (!is_null($this->errorFormatters)) {
            $listFormatter = array_wrap(data_get($this->errorFormatters, $name));

            $error = app(Pipeline::class)
                ->send($error)
                ->through($listFormatter)
                ->thenReturn();
        }
        throw new \Exception($error);
    }

    public function executeQuery($serverInfo, $query, $name = null)
    {
        $dbManager = ManagerHelpers::make($serverInfo);
        $results = $dbManager->executeQuery($query);
        return $this->parserResultData($results, $name);
    }

    public function changeSourceUrl($sourceUrl)
    {
        // config(['api.source_url' => $sourceUrl]);
        set_env('SOURCE_URL', '"'.$sourceUrl.'"');
    }
}
