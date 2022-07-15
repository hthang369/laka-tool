<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\EmbedRepository;
use Modules\Documents\Validators\Components\EmbedValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class EmbedController extends BaseDocsController
{
    protected $viewName = 'components.embed';

    public function __construct(EmbedRepository $repository, EmbedValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
