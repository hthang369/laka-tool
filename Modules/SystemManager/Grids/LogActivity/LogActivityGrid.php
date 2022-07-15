<?php

namespace Modules\SystemManager\Grids\LogActivity;

use Modules\Common\Grids\BaseGrid;

class LogActivityGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'LogActivity';

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
                'key' => 'subject',
                'filtering' => true
            ],
            [
                'key' => 'url',
                'filtering' => true
            ],
            [
                'key' => 'ip',
                'filtering' => true
            ],
            [
                'key' => 'method',
                'filtering' => true
            ],
            [
                'key' => 'user_name',
                'filtering' => true
            ],
            [
                'key' => 'agent',
                'filtering' => true
            ],
        ];
    }
}
