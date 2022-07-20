<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\HeadlineModel;
use Modules\Documents\Grids\Components\HeadlineGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class HeadlineRepository extends BaseDocsRepository
{
    protected $presenterClass = HeadlineGrid::class;

    protected $modelClass = HeadlineModel::class;
}
