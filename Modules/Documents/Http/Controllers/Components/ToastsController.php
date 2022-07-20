<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ToastsRepository;
use Modules\Documents\Validators\Components\ToastsValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ToastsController extends BaseDocsController
{
    protected $viewName = 'components.toasts';

    public function __construct(ToastsRepository $repository, ToastsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
