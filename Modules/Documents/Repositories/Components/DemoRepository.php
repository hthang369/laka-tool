<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\DemoModel;
use Modules\Documents\Grids\Components\DemoGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class DemoRepository extends BaseDocsRepository
{
    protected $presenterClass = DemoGrid::class;

    protected $modelClass = DemoModel::class;
}
