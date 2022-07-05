<?php

namespace Modules\LakaManager\Repositories\BusinessPlans;

use Modules\LakaManager\Entities\BusinessPlans\BusinessPlanModel;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\FullTextSearchClause;
use Modules\LakaManager\Forms\BusinessPlans\BusinessPlanForm;
use Modules\LakaManager\Grids\BusinessPlans\BusinessPlanGrid;

class BusinessPlanRepository extends CoreRepository
{
    protected $presenterClass = BusinessPlanGrid::class;

    protected $modelClass = BusinessPlanModel::class;

    protected $filters = [
        'name' => FullTextSearchClause::class
    ];

    public function form()
    {
        return BusinessPlanForm::class;
    }
}
