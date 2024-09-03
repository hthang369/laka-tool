<?php

namespace Modules\Api\Repositories;

use Modules\Api\Entities\DBToolModel;
use Modules\Api\Entities\Tools\ConfigsModel;
use Modules\Api\Repositories\Formatters\GitBrandErrorFormatter;
use Modules\Api\Repositories\Formatters\GitBrandFormatter;

class DBToolRepository extends BaseCoreRepository
{
    protected $modelClass = DBToolModel::class;

    protected $formatters = [
        'GIT_BRANCH' => GitBrandFormatter::class
    ];

    protected $errorFormatters = [
        'GIT_DELETE_BRANCH' => GitBrandErrorFormatter::class
    ];

    public function clipboardBrowse($data)
    {
        $lstData = explode(PHP_EOL, $data);

        $header = array_pull($lstData, 0);
        $lstHeader = explode("\t", $header);
        $listRow = [];
        foreach ($lstData as $item) {
            array_push($listRow, array_combine($lstHeader, explode("\t", $item)));
        }

        return $listRow;
    }

    public function getHostsInfo()
    {
        $result = ConfigsModel::where([
            'type' => 'host',
            'key' => 'hosts'
        ])->with(['config_path' => function($query) {
            return $query->whereHas('osys', function($subquery) {
                return $subquery->where('name', PHP_OS);
            });
        }])->first();
        $path = data_get($result->config_path->first(), 'path');
        $fileName = array_first($result->value);
        return "{$path}{$fileName}";
    }
}
