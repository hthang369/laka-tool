<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\MediaRepository;
use Modules\Documents\Validators\Components\MediaValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class MediaController extends BaseDocsController
{
    protected $viewName = 'components.media';

    public function __construct(MediaRepository $repository, MediaValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
