<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ButtonRepository;
use Modules\Documents\Validators\Components\ButtonValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ButtonController extends BaseDocsController
{
    protected $viewName = 'components.button';

    public function __construct(ButtonRepository $repository, ButtonValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
