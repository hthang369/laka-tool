<?php

namespace App\Presenters\Companys;

use App\Models\BusinessPlans\BusinessPlan;
use App\Presenters\BaseGridPresenter;

class CompanyGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering' => true,
            ],
            [
                'key' => 'email',
                'filtering' => true,
            ],
            [
                'key' => 'phone',
                'filtering' => true,
            ],
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
