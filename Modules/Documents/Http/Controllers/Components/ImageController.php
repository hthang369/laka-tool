<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ImageRepository;
use Modules\Documents\Validators\Components\ImageValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class ImageController extends CoreController
{
    public function __construct(ImageRepository $repository, ImageValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
