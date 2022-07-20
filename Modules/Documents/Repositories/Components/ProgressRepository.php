<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\ProgressModel;
use Modules\Documents\Grids\Components\ProgressGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class ProgressRepository extends BaseDocsRepository
{
    protected $presenterClass = ProgressGrid::class;

    protected $modelClass = ProgressModel::class;
}
