<?php

namespace App\Presenters\Companys;

use App\Models\BusinessPlans\BusinessPlan;
use App\Presenters\CoreGridPresenter;

class CompanyGridPresenter extends CoreGridPresenter
{
    protected $name = 'company';

    protected function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering' => true
            ],
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
