<?php

namespace Modules\LakaManager\Grids\LakaUsers;

use Carbon\Carbon;
use Modules\Common\Grids\BaseGrid;

class LakaUserApprovalApiTokenGrid extends BaseGrid
{
    protected $name = 'approval-api-token';
    // protected $actionColumnOptions = [
    //     'visible' => false,
    // ];

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
            // [
            //     'key' => 'action',
            //     'sortable' => false,
            //     'dataType' => 'buttons',
            //     'cell' => 'laka-user-management.btn-accept',
            // ]
        ];
    }

    protected function configureButtons()
    {
        parent::configureButtons();
        $this->addRowButton('pause', [
            'key' => 'pause',
            'name' => 'pause',
            'title' => translate('table.btn_create'),
            'label' => translate('table.btn_create'),
            'size' => '',
            'position' => 1,
            'renderCustom' => "laka-user-management.btn-accept",
            'url' => function($item) {
                return $this->getCreareUrl();
            },
            'dataAttributes' => [
                'loading' => translate('table.loading_text')
            ],
            'icon' => 'fa-plus-circle',
            'visible' => function($item) {
                return $this->visibleUpdate($item);
            }
        ]);
    }

    protected function visibleCreate()
    {
        return false;
    }

    protected function visibleEdit($item)
    {
        return false;
    }

    protected function visibleDetail($item)
    {
        return false;
    }

    protected function visibleUpdate($item)
    {
        return user_can("edit_{$this->getSectionCode()}");
    }

    protected function getDeleteUrl($params)
    {
        return $params ? route($this->getSectionCode().'.delete-token', $this->genarateParams('destroy', $params)) : '';
    }
}
