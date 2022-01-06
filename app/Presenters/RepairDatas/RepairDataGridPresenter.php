<?php

namespace App\Presenters\RepairDatas;

use App\Presenters\BaseGridPresenter;

class RepairDataGridPresenter extends BaseGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'status'
        ];
    }
}
