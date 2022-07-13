<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\CarouselModel;
use Modules\Documents\Grids\Components\CarouselGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class CarouselRepository extends BaseDocsRepository
{
    protected $presenterClass = CarouselGrid::class;

    protected $modelClass = CarouselModel::class;
}
