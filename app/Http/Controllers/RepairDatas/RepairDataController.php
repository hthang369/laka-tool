<?php

namespace App\Http\Controllers\RepairDatas;

use App\Http\Controllers\Core\CoreController;
use App\Jobs\ProcessPodcast;
use App\Repositories\RepairDatas\RepairDataRepository;
use App\Validators\RepairDatas\RepairDataValidator;
use Illuminate\Support\Facades\View;
use Laka\Core\Facades\Common;

/**
 * Class RepairDataController
 * @package App\Http\Controllers\RepairDatas
 * @property RepairDataRepository repairdataRepository
 */
class RepairDataController extends CoreController
{
    protected $listViewName = [
        'index' => 'repair-data.index'
    ];

    public function __construct(RepairDataRepository $repository, RepairDataValidator $validator) {
        parent::__construct($repository, $validator);

        View::share('titlePage', __('repair_data.page_title'));
        View::share('headerPage', 'repair_data.page_header');
    }

    public function runTest()
    {
        ProcessPodcast::dispatch();
    }
}
