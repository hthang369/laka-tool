<?php

namespace Modules\LakaManager\Repositories\RepairDatas;

use Modules\LakaManager\Entities\RepairDatas\RepairDataModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\LakaManager\Grids\RepairDatas\RepairDataGrid;

class RepairDataRepository extends CoreRepository
{
    protected $presenterClass = RepairDataGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RepairDataModel::class;
    }
}
