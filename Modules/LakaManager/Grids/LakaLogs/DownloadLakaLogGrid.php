<?php

namespace Modules\LakaManager\Grids\LakaLogs;

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
        return [
            [
                'key' => 'name',
                'filtering' => true,
            ],
            [
                'key' => 'status',
                'cell' => function ($item) {
                    if ($item->status == true) {
                        return '<span class="badge badge-success">' . __('laka_log.log-parsed') . '</span>';
                    } else {
                        return '<span class="badge badge-danger">' . __('laka_log.log-not-parsed') . '</span>';
                    }
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
}
