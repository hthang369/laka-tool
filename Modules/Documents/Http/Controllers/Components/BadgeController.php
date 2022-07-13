<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\BadgeRepository;
use Modules\Documents\Validators\Components\BadgeValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class BadgeController extends BaseDocsController
{
    protected $viewName = 'components.badge';

    public function __construct(BadgeRepository $repository, BadgeValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
