<?php

namespace App\Presenters\LakaLogs;

use App\Presenters\BaseGridPresenter;

class DownloadLakaLogGridPresenter extends BaseGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
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
            ],
        ];
    }
}
