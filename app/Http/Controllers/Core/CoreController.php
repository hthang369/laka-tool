<?php

namespace App\Http\Controllers\Core;

use Laka\Core\Http\Controllers\BaseController;
use Laka\Core\Http\Response\JsonResponse;
use Laka\Core\Http\Response\WebResponse;
use Laka\Core\Validators\BaseValidator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

/**
 * Class CoreController
 * @package App\Http\Controllers\Core
 */
abstract class CoreController extends BaseController
{
    public function __construct(BaseValidator $validator)
    {
        parent::__construct($validator);

        View::share('sectionCode', $this->getSectionCode());
    }

    public function create()
    {     
        $data = $this->repository->formGenerate(); 

        return WebResponse::success($this->getViewName(__FUNCTION__), $data);
    }

    public function edit($id)
    {  
        $data = $this->repository->show($id); 

        return WebResponse::success($this->getViewName(__FUNCTION__), $data);
    }

    public function destroy($id) {
        $this->repository->delete($id);

        return JsonResponse::deleted();
    }
}
