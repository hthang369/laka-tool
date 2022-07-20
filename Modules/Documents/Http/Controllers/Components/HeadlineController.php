<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\HeadlineRepository;
use Modules\Documents\Validators\Components\HeadlineValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class HeadlineController extends BaseDocsController
{
    protected $viewName = 'components.embed';

    public function __construct(HeadlineRepository $repository, HeadlineValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
