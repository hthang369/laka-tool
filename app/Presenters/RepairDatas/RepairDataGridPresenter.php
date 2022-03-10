<?php

namespace App\Presenters\RepairDatas;

use App\Enums\RepairStatus;
use App\Facades\Common;
use App\Presenters\CoreGridPresenter;
use Collective\Html\FormBuilder;
use Collective\Html\FormFacade;

class RepairDataGridPresenter extends CoreGridPresenter
{
    protected $name = 'repairDatas';

    protected $actionColumnOptions = [
        'visible' => false,
    ];

    private $variantBtns = [
        true => 'primary',
        false => 'secondary'
    ];

    protected function setColumns()
    {
        $dataSource = Common::getLookupOptionsByEnumType(RepairStatus::class);
        $lookup = collect($dataSource)->pluck('name', 'id');
        return [
            'name',
            [
                'key' => 'status',
                'lookup' => [
                    'dataSource' => $dataSource,
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
                'formatter' => function($value, $key, $item) use($lookup) {
                    return Common::formatBadge(data_get($lookup, $value), 'info');
                }
            ],
            [
                'key' => 'created_at',
                'sortable' => false
            ],
            [
                'key' => 'action',
                'label' => 'Action',
                'sortable' => false,
                'cell' => function($itemData) {
                    $variantDownload = data_get($this->variantBtns, str_is($itemData['status'], RepairStatus::NONE));
                    $variantRestore = data_get($this->variantBtns, !str_is($itemData['status'], RepairStatus::RESTORE));
                    return FormFacade::btButton('Download', $variantDownload, [
                        'class' => 'btn-sm btn-run',
                        'icon' => 'fa-download',
                        'id' => 'btn-run-'.$itemData['id'],
                        'disabled' => !str_is($itemData['status'], RepairStatus::NONE),
                        'data-text' => 'Download',
                        'data-loading' => translate('table.loading_text'),
                        'data-id' => $itemData['id'],
                        'data-name' => $itemData['path']], 'download', $this->getSectionCode()).' '.
                    FormFacade::btButton('Restore', $variantRestore, [
                        'class' => 'btn-sm btn-restore',
                        'icon' => 'fa-sync',
                        'id' => 'btn-restore-'.$itemData['id'],
                        'disabled' => str_is($itemData['status'], RepairStatus::RESTORE),
                        'data-id' => $itemData['id'],
                        'data-text' => 'Restore',
                        'data-loading' => translate('table.loading_text'),
                        'data-name' => $itemData['path']
                    ], 'upload', $this->getSectionCode());
                }
            ]
        ];
    }
}
