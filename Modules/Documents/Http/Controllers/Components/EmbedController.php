<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\EmbedRepository;
use Modules\Documents\Validators\Components\EmbedValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class EmbedController extends CoreController
{
    public function __construct(EmbedRepository $repository, EmbedValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
