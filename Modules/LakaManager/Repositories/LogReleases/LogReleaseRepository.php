<?php

namespace Modules\LakaManager\Repositories\LogReleases;

use Modules\LakaManager\Entities\LogReleases\LogReleaseModel;
use Modules\LakaManager\Grids\LogReleases\LogReleaseGrid;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;

class LogReleaseRepository extends CoreRepository
{
    protected $presenterClass = LogReleaseGrid::class;

    protected $modelClass = LogReleaseModel::class;

    protected $filters = [
        'environment' => WhereLikeClause::class,
        'deploy_server_id' => WhereClause::class,
        'redmine_id' => WhereLikeClause::class,
        'version' => WhereLikeClause::class,
        'release_type' => WhereLikeClause::class
    ];
}
