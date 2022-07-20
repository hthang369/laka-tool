<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\ButtonModel;
use Modules\Documents\Grids\Components\ButtonGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class ButtonRepository extends BaseDocsRepository
{
    protected $presenterClass = ButtonGrid::class;

    protected $modelClass = ButtonModel::class;
}
