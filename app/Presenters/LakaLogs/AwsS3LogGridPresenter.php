<?php

namespace App\Presenters\LakaLogs;

use App\Presenters\BaseGridPresenter;

class AwsS3LogGridPresenter extends BaseGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering'=>true,
            ],
            [
                'key' => 'isDownloaded',
                'label' => __('laka_log.fields.status'),
                'sortable' => false,
                'cell' => function ($item) {
                    if ($item['isDownloaded']) {
                        $text = __('laka_log.downloaded');
                        return '<span class="badge badge-info">' . $text . '</span>';
                    } else {
                        return '';
                    }
                }
            ],
            [
                'key' => 'action',
                'label' => translate('table.action'),
                'sortable' => false,
                'dataType'=>'buttons',
                'cell' => 'laka-log.button-download'
            ]
        ];
    }
}
