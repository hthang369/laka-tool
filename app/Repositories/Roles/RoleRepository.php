<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use App\Presenters\Roles\RoleGridPresenter;
use App\Repositories\Core\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class RoleRepository extends CoreRepository
{
    protected $modelClass = Role::class;

    protected $filters = [
        'level' => WhereLikeClause::class,
        'name' => WhereLikeClause::class,
        'role_rank' => WhereLikeClause::class,
    ];

    protected $presenterClass = RoleGridPresenter::class;
}
