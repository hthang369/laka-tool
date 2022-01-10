<?php

namespace App\Presenters\RepairDatas;

use Laka\Core\Grids\BaseGridPresenter;

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
