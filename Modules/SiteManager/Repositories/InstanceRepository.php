<?php

namespace Modules\SiteManager\Repositories;

use Modules\SiteManager\Entities\InstanceModel;
use Modules\SiteManager\Grids\InstanceGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\SiteManager\Forms\InstanceForm;

class InstanceRepository extends CoreRepository
{
    protected $presenterClass = InstanceGrid::class;

    protected $modelClass = InstanceModel::class;
}
