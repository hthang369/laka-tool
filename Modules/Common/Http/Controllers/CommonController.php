<?php

namespace Modules\Common\Http\Controllers;

use Modules\Common\Repositories\CommonRepository;
use Modules\Common\Validators\CommonValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CommonController extends CoreController
{
    public function __construct(CommonRepository $repository, CommonValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
