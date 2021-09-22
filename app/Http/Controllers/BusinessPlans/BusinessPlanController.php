<?php

namespace App\Http\Controllers\BusinessPlans;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\BusinessPlans\BusinessPlanRepository;
use App\Validators\BusinessPlans\BusinessPlanValidator;
use Illuminate\Support\Facades\View;

/**
 * Class BusinessPlanController
 * @package App\Http\Controllers\BusinessPlans
 * @property BusinessPlanRepository businessplanRepository
 */
class BusinessPlanController extends CoreController
{
    protected $listViewName = [
        'index'     => 'business-plan.list',
        'create'    => 'business-plan.create',
        'edit'      => 'business-plan.update',
        'show'      => 'bussiness-plan.detail',
        'store'     => 'bussiness-plan.index',
    ];

    protected $errorRouteName = [
        'store'     => 'bussiness-plan.create',
        'update'    => 'bussiness-plan.edit'
    ];

    public function __construct(BusinessPlanValidator $validator) {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(BusinessPlanRepository::class);

        View::share('titlePage', __('business_plan.page_title'));
        View::share('headerPage', 'business_plan.page_header');
    }
}
