<?php

namespace Modules\Documents\Grids;

use Laka\Core\Grids\BaseGridPresenter;

class BaseDocsGrid extends BaseGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected $indexColumnOptions = [
        'visible' => false,
    ];

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return ['property', 'type', 'default', 'description'];
    }

    public function present($results)
    {
        $results['properties'] = array_map(function($item) {
            return parent::present($item);
        }, $results['properties']);

        return $results;
    }
}
