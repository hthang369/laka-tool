<?php

namespace Modules\SystemManager\Repositories\Roles;

use Illuminate\Database\Eloquent\Builder;
use Modules\SystemManager\Entities\Roles\RoleModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\SystemManager\Forms\Roles\RoleForm;
use Modules\SystemManager\Grids\Roles\RoleGrid;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;

class RoleRepository extends CoreRepository
{
    protected $presenterClass = RoleGrid::class;

    protected $filters = [
        'level' => WhereLikeClause::class,
        'name' => WhereLikeClause::class,
        'role_rank' => WhereLikeClause::class
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoleModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return RoleForm::class;
    }

    protected function defaultOrderBy(Builder $query)
    {
        $query->orderBy('role_rank','desc');
        return parent::defaultOrderBy($query);
    }
}
