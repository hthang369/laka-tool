<?php

namespace Modules\LakaManager\Grids\LakaLogs;

use Modules\Common\Grids\BaseGrid;

class AwsS3LogGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'AwsS3Log';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'name',
                'filtering'=>true,
            ],
            [
                'key' => 'isDownloaded',
                'label' => __('laka_log.fields.status'),
                'sortable' => false,
                'cell' => function ($item) {
                    if ($item['isDownloaded']) {
                        $text = __('laka_log.downloaded');
                        return '<span class="badge badge-info">' . $text . '</span>';
                    } else {
                        return '';
                    }
                }
            ],
            [
                'key' => 'action',
                'label' => translate('table.action'),
                'sortable' => false,
                'dataType'=>'buttons',
                'cell' => 'laka-log.button-download'
            ]
        ];
    }

    protected function visibleCreate()
    {
        return false;
    }
}
