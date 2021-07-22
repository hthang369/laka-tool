<?php

namespace App\Presenters\RoleHasPermissions;

use App\Presenters\BaseGridPresenter;
use App\Transformers\RoleHasPermissionsTransformer;
use Illuminate\Support\Facades\View;

class RoleHasPermissionGridPresenter extends BaseGridPresenter
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
                'label' => __('permission'),
                'cell' => 'roles.permission_role'
            ]
        ];
    }

    public function present($results)
    {
        View::share(array_only($results, ['user_count']));
        $resultData = with(new RoleHasPermissionsTransformer())->transformList($results['data']->toArray());
        return $this->parsePresent($resultData, count($resultData));
    }
}
