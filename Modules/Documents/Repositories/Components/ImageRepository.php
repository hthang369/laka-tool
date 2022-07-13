<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\ImageModel;
use Modules\Documents\Grids\Components\ImageGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class ImageRepository extends BaseDocsRepository
{
    protected $presenterClass = ImageGrid::class;

    protected $modelClass = ImageModel::class;
}
