<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\CarouselRepository;
use Modules\Documents\Validators\Components\CarouselValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class CarouselController extends BaseDocsController
{
    protected $viewName = 'components.carousel';

    public function __construct(CarouselRepository $repository, CarouselValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
