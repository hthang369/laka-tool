<?php

namespace Modules\LakaManager\Repositories\Companys;

use Modules\LakaManager\Entities\Companys\CompanyModel;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Modules\LakaManager\Forms\Companys\CompanyForm;
use Modules\LakaManager\Grids\Companys\CompanyGrid;

class CompanyRepository extends CoreRepository
{
    protected $presenterClass = CompanyGrid::class;

    protected $modelClass = CompanyModel::class;

    protected $filters = [
        'name' => WhereLikeClause::class,
        'email' => WhereLikeClause::class,
        'phone' => WhereLikeClause::class,
        'business_plan_id' => WhereClause::class,
    ];

    public function form()
    {
        return CompanyForm::class;
    }
}
