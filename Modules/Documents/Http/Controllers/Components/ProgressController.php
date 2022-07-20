<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ProgressRepository;
use Modules\Documents\Validators\Components\ProgressValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ProgressController extends BaseDocsController
{
    protected $viewName = 'components.progress';

    public function __construct(ProgressRepository $repository, ProgressValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
