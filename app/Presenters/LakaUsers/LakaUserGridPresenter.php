<?php

namespace App\Presenters\LakaUsers;

use App\Models\Companys\Company;
use App\Presenters\CoreGridPresenter;

class LakaUserGridPresenter extends CoreGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false
    ];

    protected function setColumns()
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
                    'dataSource' => resolve(Company::class)->all(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
            ],
            [
                'key' => 'action',
                'sortable' => false,
                'dataType' => 'buttons',
                'cell' => function ($item) {
                    if (str_is(last(request()->segments()), 'add-contact')) {
                        return bt_link_to_route("laka-user-management.edit", __('common.update'), 'primary', [$item['id']], ['class' => 'btn-sm', 'icon' => 'fa-edit']);
                    } else {
                        if ($item['disabled'] === 0) {
                            return bt_link_to_route("laka-user-management.disable-user", __('common.disable'), 'danger', [$item['id'], 'type' => 'sent-mail'], ['class' => 'btn-sm', 'icon' => "far fa-ban",'onclick'=>"return confirm('".__('common.confirm_disable')."')"]);
                        }
                        return '<span class="badge badge-info">' . __('users.laka.disable') . '</span>';
                    }
                }
            ],
        ];
    }
}
