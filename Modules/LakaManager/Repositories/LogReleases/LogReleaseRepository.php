<?php

namespace Modules\LakaManager\Repositories\LogReleases;

use Modules\LakaManager\Entities\LogReleases\LogReleaseModel;
use Modules\LakaManager\Grids\LogReleases\LogReleaseGrid;
use Laka\Core\Repositories\CoreRepository;

class LogReleaseRepository extends CoreRepository
{
    protected $presenterClass = LogReleaseGrid::class;

    protected $modelClass = LogReleaseModel::class;
}
