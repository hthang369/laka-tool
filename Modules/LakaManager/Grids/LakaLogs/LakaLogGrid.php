<?php

namespace Modules\LakaManager\Grids\LakaLogs;

use Modules\Common\Grids\BaseGrid;

class LakaLogGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'LakaLog';

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
                'key' => 'log_level',
                'filtering' => true,
            ], [
                'key' => 'ip',
                'filtering' => true,
            ], [
                'key' => 'date_log',
            ],
            [
                'key' => 'url',
                'filtering' => true,
            ],
        ];
    }

    protected function visibleCreate()
    {
        return false;
    }
}
