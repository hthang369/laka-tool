<?php

namespace Modules\LakaManager\Http\Controllers\Companys;

use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\Companys\CompanyRepository;
use Modules\LakaManager\Validators\Companys\CompanyValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CompanyController extends CoreController
{
    protected $defaultName = 'company';

    public function __construct(CompanyRepository $repository, CompanyValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('company.page_title'));
        View::share('headerPage', 'company.page_header');
    }
}
