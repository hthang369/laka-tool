<?php

namespace App\Http\Controllers\Commons;

use Laka\Core\Http\Response\WebResponse;
use App\Http\Controllers\Core\CoreController;
use App\Repositories\Commons\CommonRepository;
use App\Validators\Commons\CommonValidator;

/**
 * Class CommonController
 * @package App\Http\Controllers\Commons
 * @property CommonRepository commonRepository
 */
class CommonController extends CoreController
{
    protected $listViewName = [];

    protected $permissionActions = [
        'confirmDialog' => 'public'
    ];

    public function __construct(CommonRepository $repository, CommonValidator $validator)
    {
        parent::__construct($repository, $validator);
    }

    public function confirmDialog($id)
    {
        return WebResponse::success('common.dialog_confirm_delete', ['id' => $id]);
    }
}
