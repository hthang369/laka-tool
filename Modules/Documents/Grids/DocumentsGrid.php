<?php

namespace Modules\Documents\Grids;

use Modules\Common\Grids\BaseGrid;

class DocumentsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Documents';

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
