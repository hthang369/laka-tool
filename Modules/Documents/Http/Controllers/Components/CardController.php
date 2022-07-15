<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\CardRepository;
use Modules\Documents\Validators\Components\CardValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Documents\Http\Controllers\BaseDocsController;

class CardController extends BaseDocsController
{
    protected $viewName = 'components.card';

    public function __construct(CardRepository $repository, CardValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
