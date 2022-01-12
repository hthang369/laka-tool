<?php

namespace App\Presenters\RepairDatas;

use App\Presenters\CoreGridPresenter;

class RepairDataGridPresenter extends CoreGridPresenter
{
    protected function setColumns()
    {
        return [
            'name',
            'status'
        ];
    }
}
