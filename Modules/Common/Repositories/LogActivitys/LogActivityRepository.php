<?php

namespace Modules\Common\Repositories\LogActivitys;

use Laka\Core\Repositories\BaseRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Modules\Common\Entities\LogActivitys\LogActivity;

class LogActivityRepository extends BaseRepository
{
    protected $modelClass = LogActivity::class;

    protected $filters = [
        'name' => WhereClause::class
    ];
}
