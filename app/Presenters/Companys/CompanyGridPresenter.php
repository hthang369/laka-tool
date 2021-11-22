<?php

namespace App\Presenters\Companys;

use App\Models\BusinessPlans\BusinessPlan;
use App\Presenters\BaseGridPresenter;

class CompanyGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'email',
            'phone',
            'address',
            [
                'key' => 'business_plan_id',
                // 'filtering' => true,
                'lookup' => [
                    'dataSource' => resolve(BusinessPlan::class)->all(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ]
            ]
        ];
    }
}
