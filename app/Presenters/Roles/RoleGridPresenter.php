<?php

namespace App\Presenters\Roles;

use App\Presenters\BaseGridPresenter;
use Spatie\Permission\Models\Role;

class RoleGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            'level',
            'name',
            'role_rank',
            [
                'key'   => 'role_setting',
                'label' => __('role.fields.role_setting'),
                'cell'  => 'roles.permission'
            ]
        ];
    }

    protected function visibleDelete($item)
    {
        return (Role::find($item->id)->users()->count() == 0) && parent::visibleDelete($item);
    }
}
