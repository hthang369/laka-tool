<?php

namespace Modules\Documents\Grids\Components;

use Modules\Documents\Grids\BaseDocsGrid;

class LinkGrid extends BaseDocsGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Link';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [];
    }
}
