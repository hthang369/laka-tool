<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\LinkModel;
use Modules\Documents\Grids\Components\LinkGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class LinkRepository extends BaseDocsRepository
{
    protected $presenterClass = LinkGrid::class;

    protected $modelClass = LinkModel::class;
}
