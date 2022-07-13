<?php

namespace Modules\SystemManager\Http\Controllers\Roles;

use Illuminate\Support\Facades\View;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\SystemManager\Repositories\Roles\RoleRepository;
use Modules\SystemManager\Validators\Roles\RoleValidator;

class RoleController extends CoreController
{
    protected $defaultName = 'roles';

    public function __construct(RoleRepository $repository, RoleValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('role.page_title'));
        View::share('headerPage', 'role.page_header');
        View::share('routeLink', 'role.store');
    }
}
