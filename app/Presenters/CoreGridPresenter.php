<?php

namespace App\Presenters;

use Laka\Core\Grids\BaseGridPresenter;

class CoreGridPresenter extends BaseGridPresenter
{
    protected function getHeaderInfoView()
    {
        return 'components.system-admin.header-info';
    }

    /**
     * Render the header info the grid
     *
     * @return string
     * @throws \Throwable
     */
    public function renderHeaderInfo()
    {
        return parent::renderHeaderInfo(['paginator' => $this->paginator]);
    }
}
