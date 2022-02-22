<?php

namespace App\Http\Controllers\RepairDatas;

use App\Facades\Common;
use App\Http\Controllers\Core\CoreController;
use App\Jobs\ProcessPodcast;
use App\Repositories\RepairDatas\RepairDataRepository;
use App\Validators\RepairDatas\RepairDataValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\JsonResponse;
use Prettus\Validator\Contracts\ValidatorInterface;

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

    public function store(Request $request) {
        $this->validator($request->all(), ValidatorInterface::RULE_CREATE);

        $data = $this->repository->create($request->all());

        if (method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        return JsonResponse::created($data, $this->getMessageResponse(__FUNCTION__));
    }

    public function runTest(Request $request)
    {
        ProcessPodcast::dispatch($request->input('name'), $request->input('id'));
    }
}
