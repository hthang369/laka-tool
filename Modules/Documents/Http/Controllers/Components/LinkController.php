<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\LinkRepository;
use Modules\Documents\Validators\Components\LinkValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class LinkController extends CoreController
{
    public function __construct(LinkRepository $repository, LinkValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
