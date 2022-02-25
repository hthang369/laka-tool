<?php

namespace App\Http\Controllers\RoleHasPermissions;

use Laka\Core\Http\Response\WebResponse;
use App\Http\Controllers\Core\CoreController;
use App\Models\Permissions\Role;
use App\Repositories\RoleHasPermissions\RoleHasPermissionRepository;
use App\Transformers\RoleHasPermissionsTransformer;
use App\Validators\RoleHasPermissions\RoleHasPermissionValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

    public function __construct(RoleHasPermissionRepository $repository, RoleHasPermissionValidator $validator) {
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
        View::share('parent_route', 'role-management.index');

        return WebResponse::success('role.permission', $base);
    }
}
