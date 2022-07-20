<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\BreadcrumbRepository;
use Modules\Documents\Validators\Components\BreadcrumbValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class BreadcrumbController extends BaseDocsController
{
    protected $viewName = 'components.breadcrumb';

    public function __construct(BreadcrumbRepository $repository, BreadcrumbValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
