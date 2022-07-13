<?php

namespace Modules\SystemManager\Http\Controllers\RoleHasPermissions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Permissions\Role;
use Laka\Core\Responses\BaseResponse;
use Modules\SystemManager\Repositories\RoleHasPermissions\RoleHasPermissionRepository;
use Modules\SystemManager\Validators\RoleHasPermissions\RoleHasPermissionValidator;

class RoleHasPermissionController extends CoreController
{
    protected $defaultName = 'permission-role';

    protected $listViewName = [
        'update' => 'permission-role.edit'
    ];

    protected $permissionActions = [
        'showByRole' => 'edit',
    ];

    public function __construct(RoleHasPermissionRepository $repository, RoleHasPermissionValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('role.permission_role.page_title'));
        View::share('headerPage', 'role.permission_role.page_header');
    }

    public function showByRole(Request $request, $id)
    {
        list($grid, $result) = $this->repository->getDataByRole($id);
        $role = Role::find($id);
        $result = array_add($result, 'role', $role);
        $result['modal'] = [
            'route' => route('permission-role.update', $id),
            'pjaxContainer' => $request->get('ref'),
            'title' => __('role.permission_role.page_header').': '.$role['name']
        ];

        if (user_get()->roles()->min('role_rank') > $result['role']->role_rank) {
            throw new AuthorizationException();
        }

        View::share('parent_route', 'role-management.index');

        return $this->responseView($request, compact('grid', 'result'), $this->getViewName('show'));
    }
}
