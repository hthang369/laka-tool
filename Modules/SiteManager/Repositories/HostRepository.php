<?php

namespace Modules\SiteManager\Repositories;

use Illuminate\Support\Facades\File;
use Modules\SiteManager\Entities\HostModel;
use Modules\SiteManager\Grids\HostGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Api\Repositories\DBToolRepository;
use Modules\SiteManager\Forms\HostForm;

class HostRepository extends CoreRepository
{
    protected $presenterClass = HostGrid::class;

    protected $modelClass = HostModel::class;

    protected $formClass = HostForm::class;

    public function show($id, $columns = [], $with = [])
    {
        $result = resolve(DBToolRepository::class)->getHostsInfo();
        return ['hosts' => $result];
    }
}
