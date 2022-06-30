<?php

namespace Modules\SystemManager\Grids\RoleHasPermissions;

use Illuminate\Support\Facades\View;
use Laka\Core\Grids\BaseGridPresenter;
use Modules\SystemManager\Transformers\RoleHasPermissionsTransformer;

class RoleHasPermissionGrid extends BaseGridPresenter
{
    protected $indexColumnOptions = ['visible' => false];
    protected $actionColumnOptions = ['visible' => false];

    protected function setColumns()
    {
        return [
            'no',
            'section_name',
            [
                'key' => 'permission',
                'label' => __('role.permission_role.permission'),
                'cell' => 'roles.permission_role'
            ]
        ];
    }

    public function present($results)
    {
        View::share(array_only($results, ['user_count']));
        $resultData = with(new RoleHasPermissionsTransformer())->transformList($results['data']->toArray());
        $this->resultData = $this->parsePresent($resultData, count($resultData));
        return $this->resultData;
    }

    protected function visibleCreate()
    {
        return false;
    }

    protected function visibleRefresh()
    {
        return false;
    }

    protected function visibleDetail($item)
    {
        return false;
    }
}
