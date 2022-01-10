<?php

namespace App\Presenters\BusinessPlans;

use Laka\Core\Grids\BaseGridPresenter;

class BusinessPlanGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'description',
        ];
    }
}
