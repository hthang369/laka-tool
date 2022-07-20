<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\MediaModel;
use Modules\Documents\Grids\Components\MediaGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class MediaRepository extends BaseDocsRepository
{
    protected $presenterClass = MediaGrid::class;

    protected $modelClass = MediaModel::class;
}
