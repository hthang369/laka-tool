<?php

namespace App\Presenters\Users;

use App\Presenters\BaseGridPresenter;

class UserGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'email',
            'phone',
            [
                'key' => 'roles',
                'sortable' => false,
                'cell' => function($item) {
                    $html = '';
                    foreach($item['roles'] as $role) {
                        $html .= '<span class="badge badge-primary mr-2">'.$role.'</span>';
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
        return $item;
    }
}
