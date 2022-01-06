<?php

namespace App\Repositories\BusinessPlans;

use App\Models\BusinessPlans\BusinessPlan;
use App\Presenters\BusinessPlans\BusinessPlanGridPresenter;
use App\Repositories\Core\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\FullTextSearchClause;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class BusinessPlanRepository extends CoreRepository
{
    protected $modelClass = BusinessPlan::class;

    protected $filters = [
        'name' => FullTextSearchClause::class
    ];

    protected $presenterClass = BusinessPlanGridPresenter::class;
}
