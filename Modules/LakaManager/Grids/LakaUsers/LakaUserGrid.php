<?php

namespace Modules\LakaManager\Grids\LakaUsers;

use Modules\Common\Grids\BaseGrid;
use Modules\LakaManager\Entities\Companys\CompanyModel;

class LakaUserGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'LakaUser';

    protected $actionColumnOptions = [
        'visible' => false
    ];

    protected function getUserTypeData()
    {
        return [
            ['id' => 0, 'name' => __('users.laka.user_default')],
            ['id' => 1, 'name' => __('users.laka.user_admin')]
        ];
    }

    protected function getUserBotData()
    {
        return [
            ['id' => 0, 'name' => __('users.laka.user_default')],
            ['id' => 1, 'name' => __('users.laka.is_user_bot')]
        ];
    }

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
                'filtering' => true
            ],
            [
                'key' => 'email',
                'filtering' => true
            ],
            [
                'key' => 'company',
                'lookup' => [
                    'dataSource' => resolve(CompanyModel::class)->all(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
            ],
            [
                'key' => 'user_type',
                'filtering' => true,
                'lookup' => [
                    'dataSource' => $this->getUserTypeData(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
            ],
            [
                'key' => 'is_bot',
                'filtering' => true,
                'lookup' => [
                    'dataSource' => $this->getUserBotData(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
            ],
            [
                'key' => 'action',
                'sortable' => false,
                'dataType' => 'buttons',
                'cell' => function ($item) {
                    $sectionCode = 'laka-user-management';
                    if (str_is(last(request()->segments()), 'add-contact')) {

                        return bt_link_to_route("laka-user-management.edit", __('common.update'), 'primary', [$item['id']], ['class' => 'btn-sm show_modal_form', 'icon' => 'fa-edit', 'data-modal-size' => 'modal-lg'], 'edit', $sectionCode);
                    } else {
                        if ($item['disabled'] === 0) {
                            return bt_link_to_route("laka-user-management.disable-user", __('common.disable'), 'danger', [$item['id'], 'type' => 'sent-mail', 'ref' => $this->getId()], ['class' => 'btn-sm show_modal_form', 'data-modal-size' => 'modal-lg',
                                'icon' => "far fa-ban", 'data-trigger-confirm' => '1', 'data-confirmation-msg' => __('common.confirm_disable')], 'delete', $sectionCode);
                        }
                        return '<span class="badge badge-info">' . __('users.laka.disable') . '</span>';
                    }
                }
            ]
        ];
    }
}
