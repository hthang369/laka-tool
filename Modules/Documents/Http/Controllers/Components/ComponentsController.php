<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ComponentsRepository;
use Modules\Documents\Validators\Components\ComponentsValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ComponentsController extends BaseDocsController
{
    protected $viewName = 'components.index';

    public function __construct(ComponentsRepository $repository, ComponentsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
