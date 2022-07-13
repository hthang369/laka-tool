<?php

namespace Modules\Documents\Http\Controllers;

use Modules\Documents\Repositories\DocumentsRepository;
use Modules\Documents\Validators\DocumentsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class DocumentsController extends CoreController
{
    protected $permissionActions = [
        'index' => 'public'
    ];

    protected $listViewName = [
        'index'     => 'documents::index',
    ];

    public function __construct(DocumentsRepository $repository, DocumentsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
