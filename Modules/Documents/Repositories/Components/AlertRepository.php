<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\AlertModel;
use Modules\Documents\Grids\Components\AlertGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class AlertRepository extends BaseDocsRepository
{
    protected $presenterClass = AlertGrid::class;

    protected $modelClass = AlertModel::class;
}
