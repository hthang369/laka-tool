<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\CarouselRepository;
use Modules\Documents\Validators\Components\CarouselValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CarouselController extends CoreController
{
    public function __construct(CarouselRepository $repository, CarouselValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
