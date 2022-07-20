<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\BreadcrumbModel;
use Modules\Documents\Grids\Components\BreadcrumbGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class BreadcrumbRepository extends BaseDocsRepository
{
    protected $presenterClass = BreadcrumbGrid::class;

    protected $modelClass = BreadcrumbModel::class;
}
