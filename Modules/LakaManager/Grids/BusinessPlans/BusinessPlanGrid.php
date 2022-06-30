<?php

namespace Modules\LakaManager\Grids\BusinessPlans;

use Modules\Common\Grids\BaseGrid;

class BusinessPlanGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'BusinessPlan';

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
            'description',
        ];
    }
}
