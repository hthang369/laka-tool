<?php

namespace App\Presenters\BusinessPlans;

use App\Presenters\BaseGridPresenter;

class BusinessPlanGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
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
