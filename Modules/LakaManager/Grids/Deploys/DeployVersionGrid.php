<?php

namespace Modules\LakaManager\Grids\Deploys;

use Modules\Common\Grids\BaseGrid;

class DeployVersionGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'DeployVersion';

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
