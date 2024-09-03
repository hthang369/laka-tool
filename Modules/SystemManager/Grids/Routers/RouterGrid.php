<?php

namespace Modules\SystemManager\Grids\Routers;

use Modules\Common\Grids\BaseGrid;

class RouterGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Router';

    protected $indexColumnOptions = [
        'dataType' => 'buttons'
    ];

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
                'key' => 'method',
                'filtering' => true
            ],
            [
                'key' => 'uri',
                'filtering' => true
            ],
            [
                'key' => 'name',
                'filtering' => true
            ],
            [
                'key' => 'action'
            ],
            [
                'key' => 'middleware',
                'formatter' => function($cellValue, $columnName, $rowData) {
                    return join('<br/>', $cellValue);
                }
            ]
        ];
    }
}
