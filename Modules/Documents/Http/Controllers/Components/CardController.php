<?php

namespace Modules\Documents\Http\Controllers\Components;

use Modules\Documents\Repositories\Components\CardRepository;
use Modules\Documents\Validators\Components\CardValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CardController extends CoreController
{
    public function __construct(CardRepository $repository, CardValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
