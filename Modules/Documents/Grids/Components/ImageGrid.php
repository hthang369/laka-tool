<?php

namespace Modules\Documents\Grids\Components;

use Modules\Documents\Grids\BaseDocsGrid;

class ImageGrid extends BaseDocsGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Image';

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
