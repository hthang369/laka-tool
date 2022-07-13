<?php

namespace Modules\Documents\Http\Controllers;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Repositories\BaseRepository;
use Laka\Core\Responses\BaseResponse;
use Laka\Core\Validators\BaseValidator;

class BaseDocsController extends CoreController
{
    protected $permissionActions = [
        'index' => 'public'
    ];

    protected $viewName = '';

    protected $listViewName = [
        'index'     => 'documents::%s',
    ];

    public function __construct(BaseRepository $repository, BaseValidator $validator, BaseResponse $response)
    {
        array_walk($this->listViewName, function(&$item, $key) {
            $item = sprintf($item, $this->viewName);
            return $item;
        });
        parent::__construct($repository, $validator, $response);
    }
}
