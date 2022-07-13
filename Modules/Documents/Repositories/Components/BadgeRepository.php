<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\BadgeModel;
use Modules\Documents\Grids\Components\BadgeGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class BadgeRepository extends BaseDocsRepository
{
    protected $presenterClass = BadgeGrid::class;

    protected $modelClass = BadgeModel::class;
}
