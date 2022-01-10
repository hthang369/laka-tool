<?php

namespace App\Presenters\LakaLogs;

use Laka\Core\Grids\BaseGridPresenter;

class DownloadLakaLogGridPresenter extends BaseGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
    {
        return [
            'name',
            [
                'key' => 'status',
                'cell' => function ($item) {
                    if ($item->status == true) {
                        return '<span class="badge badge-success">' . __('laka_log.log-parsed') . '</span>';
                    } else {
                        return '<span class="badge badge-danger">' . __('laka_log.log-not-parsed') . '</span>';
                    }
                }
            ], [
                'key' => 'action',
                'sortable' => false,
                'cell' => 'laka-log.button-parse'
            ],
        ];
    }
}
