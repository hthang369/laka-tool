<?php

namespace App\Presenters\RepairDatas;

use App\Presenters\CoreGridPresenter;
use Collective\Html\FormBuilder;
use Collective\Html\FormFacade;

class RepairDataGridPresenter extends CoreGridPresenter
{
    protected $name = 'repairDatas';

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
                    return FormFacade::btButton('Download', 'primary', [
                        'class' => 'btn-sm btn-run', 
                        'id' => 'btn-run-'.$itemData['id'],
                        'data-text' => 'Download',
                        'data-loading' => translate('table.loading_text'),
                        'data-id' => $itemData['id'],
                        'data-name' => $itemData['path']]).' '.
                    FormFacade::btButton('Restore', 'primary', ['class' => 'btn-sm btn-restore']);
                }
            ]
        ];
    }
}
