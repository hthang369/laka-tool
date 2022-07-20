<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\ToastsModel;
use Modules\Documents\Grids\Components\ToastsGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class ToastsRepository extends BaseDocsRepository
{
    protected $presenterClass = ToastsGrid::class;

    protected $modelClass = ToastsModel::class;
}
