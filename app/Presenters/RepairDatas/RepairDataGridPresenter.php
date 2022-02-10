<?php

namespace App\Presenters\RepairDatas;

use App\Presenters\CoreGridPresenter;
use Collective\Html\FormBuilder;
use Collective\Html\FormFacade;

class RepairDataGridPresenter extends CoreGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
    {
        return [
            'name',
            'status',
            'created_at',
            [
                'key' => 'action',
                'label' => 'Action',
                'cell' => function($itemData) {
                    return FormFacade::btButton('Restore', 'primary', ['class' => 'btn-sm btn-restore']);
                }
            ]
        ];
    }
}
