<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Repositories\DBToolRepository;
use Modules\Api\Validators\DBToolValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class DBToolController extends CoreController
{
    public function __construct(DBToolRepository $repository, DBToolValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function changeSourceUrl(Request $request)
    {
        $this->repository->changeSourceUrl($request->get('source_url'));
    }

    public function execCmd(Request $request)
    {
        $data = $this->repository->execCmd($request->get('name'), $request->get('path'), $request->get('params', []), $request->get('options'));

        return $this->response->data($request, $data);
    }

    public function execFunc(Request $request)
    {
        $data = $this->repository->execFunc($request->get('name'), $request->get('params', []));

        return $this->response->data($request, $data);
    }
}
