<?php

namespace Modules\SystemManager\Http\Controllers\Routers;

use Modules\SystemManager\Repositories\Routers\RouterRepository;
use Modules\SystemManager\Validators\Routers\RouterValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class RouterController extends CoreController
{
    public function __construct(RouterRepository $repository, RouterValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
