<?php

namespace App\Presenters\BusinessPlans;

use App\Presenters\CoreGridPresenter;

class BusinessPlanGridPresenter extends CoreGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'description',
        ];
    }
}
