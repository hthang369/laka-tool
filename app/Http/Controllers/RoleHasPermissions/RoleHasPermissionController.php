<?php

namespace App\Http\Controllers\RoleHasPermissions;

use App\Http\Controllers\Core\CoreController;
use App\Models\Permissions\Role;
use App\Repositories\RoleHasPermissions\RoleHasPermissionRepository;
use App\Validators\RoleHasPermissions\RoleHasPermissionValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\WebResponse;

/**
 * Class RoleHasPermissionController
 * @package App\Http\Controllers\RoleHasPermissions
 * @property RoleHasPermissionRepository rolehaspermissionRepository
 */
class RoleHasPermissionController extends CoreController
{
    protected $listViewName = [
        'update' => 'permission-role.show'
    ];

    protected $permissionActions = [
        'showByRole' => 'edit',
    ];

    public function __construct(RoleHasPermissionRepository $repository, RoleHasPermissionValidator $validator)
    {
        parent::__construct($repository, $validator);

        View::share('titlePage', __('role.permission_role.page_title'));
        View::share('headerPage', 'role.permission_role.page_header');
    }

    public function showByRole($id)
    {

        extract($id);
        $base = $this->repository->getDataByRole($id);
        $role = Role::find($id);
        $base = array_add($base, 'role', $role);

        if (Auth::user()->roles()->min('role_rank') > $base['role']->role_rank) {
            throw new AuthorizationException();
        }

        View::share('parent_route', 'role-management.index');

        return WebResponse::success('role.permission', ['result' => $base]);
    }
}
