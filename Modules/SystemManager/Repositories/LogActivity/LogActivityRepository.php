<?php

namespace Modules\SystemManager\Repositories\LogActivity;

use Modules\SystemManager\Entities\LogActivity\LogActivityModel;
use Modules\SystemManager\Grids\LogActivity\LogActivityGrid;
use Laka\Core\Repositories\CoreRepository;

class LogActivityRepository extends CoreRepository
{
    protected $presenterClass = LogActivityGrid::class;

    protected $modelClass = LogActivityModel::class;
}
