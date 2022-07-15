<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\LinkRepository;
use Modules\Documents\Validators\Components\LinkValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class LinkController extends BaseDocsController
{
    protected $viewName = 'components.link';

    public function __construct(LinkRepository $repository, LinkValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
