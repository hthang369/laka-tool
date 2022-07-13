<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\AlertRepository;
use Modules\Documents\Validators\Components\AlertValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class AlertController extends BaseDocsController
{
    protected $viewName = 'components.alerts';

    public function __construct(AlertRepository $repository, AlertValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
