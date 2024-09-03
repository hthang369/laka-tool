<?php

namespace Modules\Api\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Api\Entities\Tools\ConfigsModel;
use Modules\Api\Entities\Tools\DirectoriesModel;
use Modules\Api\Entities\Tools\ServersModel;
use Modules\Api\Entities\Tools\ServicesModel;
use Modules\Api\Helpers\ManagerHelpers;
use Modules\Api\Repositories\Formatters\ServerDBFormatter;
use Modules\Api\Repositories\Formatters\ServerTableFormatter;
use Modules\Api\Repositories\Formatters\ServiceFormatter;

class ServersRepository extends BaseCoreRepository
{
    protected $modelClass = ServersModel::class;

    protected $formatters = [
        'server_db' => ServerDBFormatter::class,
        'server_table' => ServerTableFormatter::class,
        'service' => ServiceFormatter::class
    ];

    public function getAllData()
    {
        $dirIterator = new \FilesystemIterator( '/Applications/App/Projects', \FilesystemIterator::SKIP_DOTS);
        $array_file_list = [];
        foreach ($dirIterator as $item) {
            if (!$item->isDir()) continue;
            array_push($array_file_list, $item->getPathname());
        }
        return [
            'services' => ServicesModel::with('servers')->get(['id', 'type', 'name']),
            'configs' => ConfigsModel::all()->groupBy('type')->map(function($item) {
                return $item->pluck('value', 'key');
            }),
            'directories' => $array_file_list //scandir('/Applications/App/Projects')//DirectoriesModel::pluck('path')
        ];
    }

    public function getConfig($name)
    {
        return config("api.{$name}");
    }

    public function getServersByService($name)
    {
        return ServersModel::with('service')->whereHas('service', function ($query) use($name) {
            return $query->where('type', $name);
        })->get();
    }

    public function getListDb($serverInfo)
    {
        $results = ManagerHelpers::make($serverInfo)->getListDatabase();
        return $this->parserResultData($results, 'server_db');
    }

    public function getListTable($serverInfo)
    {
        $results = ManagerHelpers::make($serverInfo)->getListTable();
        return $this->parserResultData($results, 'server_table');
    }

    public function getListService()
    {
        try {
            $data = $this->execServices('GET_LIST_SERVICES');
            return array_values(array_filter($data, fn($item) => !is_null($item->exit_code)));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function execActionService($action, $name)
    {
        return $this->execServices('EXEC_ACTION_SERVICES', [
            '@action@' => $action,
            '@name@' => $name
        ]);
    }

    public function create(array $attributes)
    {
        $data = [
            'host_name' => $attributes['server_name'],
            'name' => $attributes['name'],
            'user_name' => $attributes['username'],
            'password' => $attributes['password']
        ];
        return DB::transaction(function () use($data, $attributes) {
            $service = ServicesModel::firstWhere('type', $attributes['service']);
            $data['service_id'] = $service->id;
            return ServersModel::create($data);
        });
    }

    public function update(array $attributes, $id)
    {
        $data = [
            'host_name' => $attributes['server_name'],
            'name' => $attributes['name'],
            'user_name' => $attributes['username'],
            'password' => $attributes['password']
        ];
        return DB::transaction(function () use($data, $attributes) {
            $service = ServicesModel::firstWhere('type', $attributes['service']);
            $data['service_id'] = $service->id;
            // return ServersModel::update($data, $id);
        });
    }

    public function getStrategyData($srv_info, $params)
    {
        extract($params);
        return ManagerHelpers::make($srv_info)->getStrategyData($page, $limit, $filters);
    }
}
