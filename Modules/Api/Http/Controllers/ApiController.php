<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Repositories\ApiRepository;
use Modules\Api\Validators\ApiValidator;
use Laka\Core\Http\Controllers\BaseController;
use Laka\Core\Responses\BaseResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="My First API", version="0.1", description="Api db tool for application")
 */
class ApiController extends BaseController
{
    protected $permissionActions = [
        'index' => 'public',
        'getPhasing' => 'public',
    ];

    public function __construct(ApiRepository $repository, ApiValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function execCommand(Request $request)
    {
        $list = $this->repository->execCommand();

        return $this->responseView($request, $list, $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function getPhasing(Request $request)
    {
        $list = $this->repository->getPhasing(config('api.phasing'));
    }
}
