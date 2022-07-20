<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ModalRepository;
use Modules\Documents\Validators\Components\ModalValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ModalController extends BaseDocsController
{
    protected $viewName = 'components.modal';

    public function __construct(ModalRepository $repository, ModalValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
