<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use App\Presenters\Roles\RoleGridPresenter;
use App\Repositories\Core\CoreRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
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

    public function show($id, $columns = [])
    {
        $data = parent::show($id, $columns);
        if (str_is(last(request()->segments()), 'edit') && Auth::user()->highest_role > $data->role_rank) {
            throw new AuthorizationException();
        }
        return $data;
    }


}
