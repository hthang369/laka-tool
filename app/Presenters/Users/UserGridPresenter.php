<?php

namespace App\Presenters\Users;

use App\Presenters\CoreGridPresenter;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class UserGridPresenter extends CoreGridPresenter
{
    use HasRoles, HasPermissions;


    protected function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering' => true,
            ], [
                'key' => 'email',
                'filtering' => true,
            ], [
                'key' => 'phone',
                'filtering' => true,
            ],
            [
                'key' => 'roles',
                'sortable' => false,
                'cell' => function ($item) {
                    $html = '';
                    foreach ($item['roles'] as $role) {
                        $html .= '<span class="badge badge-primary mr-2">' . $role . '</span>';
                    }
                    return $html;
                }
            ],
            'address'
        ];
    }

    protected function customItemData($item)
    {
        $item['roles'] = $item->roles()->pluck('name');
        $item['role_rank'] = $item->roles()->min('role_rank');
        return $item;
    }

    protected function visibleEdit($item)
    {
        if (Auth::user()->is_user_sa) {
            return $item->role_rank >= Auth::user()->highest_role && parent::visibleEdit($item);
        } else {
            return $item->status != 1 && $item->role_rank >= Auth::user()->highest_role && parent::visibleEdit($item);
        }
        // TODO: Change the autogenerated stub
    }

    protected function visibleDelete($item)
    {
        if (Auth::user()->is_user_sa) {
            return $item->role_rank >= Auth::user()->highest_role && parent::visibleEdit($item);
        } else {
            return $item->status != 1 && $item->role_rank >= Auth::user()->highest_role && parent::visibleEdit($item);
        }
    }
    
}
