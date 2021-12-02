<?php

namespace App\Repositories\RepairDatas;

use App\Repositories\Core\CoreRepository;
use App\Models\RepairDatas\RepairData;
use App\Presenters\RepairDatas\RepairDataGridPresenter;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class RepairDataRepository extends CoreRepository
{
    protected $modelClass = RepairData::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = RepairDataGridPresenter::class;

    public function paginate($limit = null, $columns = [], $method = "paginate")
    {
        return [];
    }
}
