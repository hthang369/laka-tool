<?php

namespace Modules\LakaManager\Grids\RepairDatas;

use Collective\Html\FormFacade;
use Modules\Common\Facades\Common;
use Modules\Common\Grids\BaseGrid;
use Modules\LakaManager\Enums\RepairStatus;

class RepairDataGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'repairDatas';

    protected $actionColumnOptions = [
        'visible' => false,
    ];

    private $variantBtns = [
        true => 'primary',
        false => 'secondary'
    ];

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
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

    protected function visibleCreate()
    {
        return false;
    }
}
