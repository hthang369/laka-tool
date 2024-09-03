<?php

namespace Modules\Api\Http\Controllers;

use Laka\Core\Http\Controllers\BaseController;
use Laka\Core\Responses\BaseResponse;
use Modules\Api\Repositories\WindmillRepository;
use Modules\Api\Validators\WindmillValidator;

/**
 * @OA\Info(title="My First API", version="0.1", description="Api db tool for application")
 */
class WindmillController extends BaseController
{
    protected $permissionActions = [
        'index' => 'public',
        'store' => 'public',
    ];

    public function __construct(WindmillRepository $repository, WindmillValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
