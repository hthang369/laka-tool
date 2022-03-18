<?php

namespace App\Presenters\Roles;

use App\Presenters\CoreGridPresenter;
use Illuminate\Support\Facades\Auth;
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
                'key' => 'role_setting',
                'label' => __('role.fields.role_setting'),
                'cell' => 'roles.permission'
            ]
        ];
    }

    protected function customItemData($item)
    {
        $item['isShowBtnRoleSetting'] = Auth::user()->highest_role <= $item['role_rank'] ? true : false;
        return $item;
    }

    protected function visibleDelete($item)
    {
        return Auth::user()->highest_role <= $item->role_rank && (Role::find($item->id)->users()->count() == 0) && parent::visibleDelete($item);
    }

    protected function visibleEdit($item)
    {
        return Auth::user()->highest_role <= $item->role_rank   && parent::visibleEdit($item); // TODO: Change the autogenerated stub
    }
}
