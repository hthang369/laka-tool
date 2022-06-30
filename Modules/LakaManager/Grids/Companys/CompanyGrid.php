<?php

namespace Modules\LakaManager\Grids\Companys;

use Modules\LakaManager\Entities\BusinessPlans\BusinessPlanModel;
use Modules\Common\Grids\BaseGrid;

class CompanyGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Company';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering' => true
            ],
            [
                'key' => 'email',
                'filtering' => true
            ],
            [
                'key' => 'phone',
                'filtering' => true
            ],
            'address',
            [
                'key' => 'business_plan_id',
                'filtering' => true,
                'lookup' => [
                    'dataSource' => resolve(BusinessPlanModel::class)->all(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ]
            ]
        ];
    }
}
