<?php

namespace App\Presenters\Roles;

use App\Presenters\CoreGridPresenter;
use Spatie\Permission\Models\Role;

class RoleGridPresenter extends CoreGridPresenter
{
    protected function setColumns()
    {
        return [
            [
                'key' => 'level',
                'filtering' => true,
            ],
            [
                'key' => 'name',
                'filtering' => true,
            ],
            [
                'key' => 'role_rank',
                'filtering' => true,
            ],
            [
                'key'   => 'role_setting',
                'label' => __('role.fields.role_setting'),
                'cell'  => 'roles.permission'
            ]
        ];
    }

    protected function visibleDelete($item)
    {
        return (Role::find(data_get($item, 'id'))->users()->count() == 0) && parent::visibleDelete($item);
    }
}
