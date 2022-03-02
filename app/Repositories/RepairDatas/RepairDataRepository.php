<?php

namespace App\Repositories\RepairDatas;

use App\Facades\Common;
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

    public function create(array $attributes)
    {
        $results = Common::callApi("get", "/api/v2/repair-data/get-list")->toArray();
        if (data_get($results, 'error_code') == 0) {
            foreach(data_get($results, 'data') as $item) {
                if ($this->model->where(array_only($item, ['name', 'path']))->count() == 0) {
                    parent::create(array_only($item, ['name', 'path', 'size']));
                }
            }
        }
        return [];
    }
}
