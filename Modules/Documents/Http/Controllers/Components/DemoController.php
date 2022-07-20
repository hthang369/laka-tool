<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\DemoRepository;
use Modules\Documents\Validators\Components\DemoValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class DemoController extends BaseDocsController
{
    protected $viewName = 'components.demo';

    public function __construct(DemoRepository $repository, DemoValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
