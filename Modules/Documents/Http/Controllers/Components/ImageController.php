<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\ImageRepository;
use Modules\Documents\Validators\Components\ImageValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class ImageController extends BaseDocsController
{
    protected $viewName = 'components.image';

    public function __construct(ImageRepository $repository, ImageValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
