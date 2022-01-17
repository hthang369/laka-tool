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
                        return link_to(
                            route('laka-user-management.edit', $item['id']),
                            __('common.update'),
                            ['class' => 'btn btn-sm btn-info']);
                    } else {
                        if ($item['disabled'] === 0) {
                            return link_to(
                                route('laka-user-management.disable-user', ['id' => $item['id'], 'type' => 'sent-mail']),
                                __('common.disable'),
                                ['class' => 'btn btn-sm btn-danger', 'onclick' => "return window.confirm('Are you sure disable this user ?')"]
                            );
                        }
                        return '<span class="badge badge-info">' . __('users.laka.disable') . '</span>';
                    }
                }
            ],
        ];
    }
}
