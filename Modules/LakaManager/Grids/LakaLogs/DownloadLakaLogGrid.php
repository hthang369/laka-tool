<?php

namespace Modules\LakaManager\Grids\LakaLogs;

use Laka\Core\Facades\Common;
use Modules\Common\Grids\BaseGrid;

class DownloadLakaLogGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'DownloadLakaLog';

    protected $actionColumnOptions = [
        'visible' => false,
    ];

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        $dataSourceParse = config('lakamanager.parseStatus');
        return [
            [
                'key' => 'name',
                'filtering' => true,
            ],
            [
                'key' => 'status',
                'lookup' => [
                    'dataSource' => $dataSourceParse,
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
                'formatter' => function($value, $key, $item) use($dataSourceParse) {
                    return $this->formatterDisplayText($dataSourceParse, boolval($value));
                }
            ],
            [
                'key' => 'action',
                'sortable' => false,
                'dataType'=>'buttons',
                'cell' => 'laka-log.button-parse',
            ]
        ];
    }

    protected function visibleCreate()
    {
        return false;
    }

    private function formatterDisplayText($dataSource, $value)
    {
        $data = head(array_where($dataSource, function($item, $key) use($value) {
            return str_is($item['id'], $value);
        }));
        return Common::formatBadge(data_get($data, 'name'), data_get($data, 'color'));
    }
}
