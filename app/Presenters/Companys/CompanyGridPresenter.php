<?php

namespace App\Presenters\Companys;

use App\Models\BusinessPlans\BusinessPlan;
use Laka\Core\Grids\BaseGridPresenter;

class CompanyGridPresenter extends BaseGridPresenter
{
    protected $name = 'company';

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
