<?php

namespace Modules\SystemManager\Grids\Roles;

use Modules\Common\Grids\BaseGrid;

class RoleGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Role';

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
                'sortable' => false,
                'label' => __('role.fields.role_setting'),
                'cell' => 'roles.permission'
            ]
        ];
    }

    protected function visibleEdit($item)
    {
        return parent::visibleEdit($item) && !(user_get()->highest_role > $item->role_rank);
    }

    protected function customItemData($item)
    {
        $item['isShowBtnRoleSetting'] = user_get()->highest_role <= $item['role_rank'] ? true : false;
        return $item;
    }
}
