<?php

namespace Modules\LakaManager\Http\Controllers;

use Modules\LakaManager\Repositories\LakaManagerRepository;
use Modules\LakaManager\Validators\LakaManagerValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class LakaManagerController extends CoreController
{
    public function __construct(LakaManagerRepository $repository, LakaManagerValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
