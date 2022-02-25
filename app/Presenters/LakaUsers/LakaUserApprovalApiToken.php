<?php

namespace App\Presenters\LakaUsers;

use App\Presenters\CoreGridPresenter;
use Carbon\Carbon;

class LakaUserApprovalApiToken extends CoreGridPresenter
{
    protected $name = 'approval-api-token';
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
    {

        return [
            [
                'key' => 'id',
                'filtering' => true
            ],
            [
                'key' => 'name',
                'filtering' => true
            ],

            [
                'key' => 'request_approval_status',
                'cell' => function ($item) {
                    $arrStatus = [
                        1 => 'no-accepted',
                        2 => 'accepted',
                        3 => 'pause',
                    ];
                    $keyStatus = $item['request_approval_status'];
                    return '<span class="badge badge-info">' . __("users.laka.approval-token.{$arrStatus[$keyStatus]}") . '</span>';


                }
            ], [
                'key' => 'request_approval_timestamp',
                'cell' => function ($item) {
                    return Carbon::parse($item['request_approval_timestamp']);
                }
            ],
            [
                'key' => 'action',
                'sortable' => false,
                'dataType' => 'buttons',
                'cell' => 'laka-user-management.btn-accept',
            ]
        ];
    }
}
