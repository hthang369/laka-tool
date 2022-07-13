<?php

namespace Modules\Common\Grids;

use Laka\Core\Grids\BaseGridPresenter;

class BaseGrid extends BaseGridPresenter
{
    protected function getHeaderInfoView()
    {
        return layouts_path('home', 'partial.header-info');
    }

    /**
     * Render the header info the grid
     *
     * @return string
     * @throws \Throwable
     */
    public function renderHeaderInfo()
    {
        $params = array_wrap(array_first(func_get_args()));
        return parent::renderHeaderInfo(array_add($params, 'paginator', $this->paginator));
    }

    /**
    * Configure rendered buttons, or add your own
    *
    * @return void
    */
    protected function configureButtons()
    {
        parent::configureButtons();
        $this->editToolbarButton('create', ['size' => 'sm']);
        $this->editToolbarButton('refresh', ['size' => 'sm', 'icon' => 'fa-sync']);
        $this->editRowButton('edit', ['mergeClass' => ['grid-row-button']]);
        $this->editRowButton('detail', ['mergeClass' => ['grid-row-button']]);
    }

    protected function buttonConfigure($name)
    {
        $btnConfs = config("laka.buttonConfigs");
        data_set($btnConfs, 'create.dataAttributes', ['modal-size' => 'modal-lg']);
        data_set($btnConfs, 'edit.dataAttributes', ['modal-size' => 'modal-lg']);
        data_set($btnConfs, 'show.dataAttributes', ['modal-size' => 'modal-lg']);
        return data_get($btnConfs, $name);
    }
}
