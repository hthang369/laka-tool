<?php

namespace Modules\LakaManager\Http\Controllers\BusinessPlans;

use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\BusinessPlans\BusinessPlanRepository;
use Modules\LakaManager\Validators\BusinessPlans\BusinessPlanValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class BusinessPlanController extends CoreController
{
    protected $defaultName = 'business-plan';

    public function __construct(BusinessPlanRepository $repository, BusinessPlanValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('business_plan.page_title'));
        View::share('headerPage', 'business_plan.page_header');
    }
}
