<?php

namespace Modules\LakaManager\Http\Controllers\RepairDatas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\RepairDatas\RepairDataRepository;
use Modules\LakaManager\Validators\RepairDatas\RepairDataValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Http\Response\JsonResponse;
use Laka\Core\Responses\BaseResponse;
use Prettus\Validator\Contracts\ValidatorInterface;

class RepairDataController extends CoreController
{
    protected $defaultName = 'repair-data';

    public function __construct(RepairDataRepository $repository, RepairDataValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

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

    public function downloadData(Request $request)
    {
        ProcessPodcast::dispatch($request->input('name'), $request->input('id'));
    }

    public function restoreDataRedis(Request $request)
    {
        RestoreRedisData::dispatch($request->input('name'), $request->input('id'));
    }
}
