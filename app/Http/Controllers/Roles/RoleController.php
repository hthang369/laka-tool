<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\Roles\RoleRepository;
use App\Validators\Roles\RoleValidator;
use Illuminate\Support\Facades\View;

/**
 * Class RoleController
 * @package App\Http\Controllers\Roles
 * @property RoleRepository roleRepository
 */
class RoleController extends CoreController
{
    protected $listViewName = [
        'index'     => 'role.list',
        'create'    => 'role.create',
        'edit'      => 'role.update',
        'show'      => 'role.detail',
        'store'     => 'role-management.index',
        'update'    => 'role-management.index',
    ];

    protected $errorRouteName = [
        'store'     => 'role-management.create',
        'update'    => 'role-management.edit'
    ];

    public function __construct(RoleRepository $repository, RoleValidator $validator) {
        parent::__construct($repository, $validator);

        View::share('titlePage', __('role.page_title'));
        View::share('headerPage', 'role.page_header');
        View::share('routeLink', 'role.store');
    }
}
