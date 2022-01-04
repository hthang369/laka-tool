<?php

namespace App\Repositories\Companys;

use App\Models\Companys\Company;
use App\Presenters\Companys\CompanyGridPresenter;
use App\Repositories\BusinessPlans\BusinessPlanRepository;
use App\Repositories\Core\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class CompanyRepository extends CoreRepository
{
    protected $modelClass = Company::class;

    protected $filters = [
        'name' => WhereLikeClause::class,
        'email' => WhereLikeClause::class,
        'phone' => WhereLikeClause::class,
    ];

    protected $select = [
        'business_plan_id'
        // 'business_plan_name:business_plan,business_plan_id,name'
    ];

    protected $presenterClass = CompanyGridPresenter::class;

    public function formGenerate()
    {
        $businessPlanRepo = resolve(BusinessPlanRepository::class);
        return ['listBusinessPlan' => $businessPlanRepo->all()];
    }

    public function show($id, $columns = [])
    {
        $data = parent::show($id, $columns);
        $bussines = $this->formGenerate();
        $data['listBusinessPlan'] = $bussines['listBusinessPlan'];
        return $data;
    }
}
