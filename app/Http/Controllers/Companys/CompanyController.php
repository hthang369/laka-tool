<?php

namespace App\Http\Controllers\Companys;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\Companys\CompanyRepository;
use App\Validators\Companys\CompanyValidator;
use Illuminate\Support\Facades\View;

/**
 * Class CompanyController
 * @package App\Http\Controllers\Companys
 * @property CompanyRepository companyRepository
 */
class CompanyController extends CoreController
{
    protected $listViewName = [
        'index'     => 'company.list',
        'create'    => 'company.create',
        'edit'      => 'company.update',
        'update'    => 'company.index',
        'show'      => 'company.detail',
        'store'     => 'company.index',
    ];

    protected $errorRouteName = [
        'store'     => 'company.create',
        'update'    => 'company.edit'
    ];

    public function __construct(CompanyRepository $repository, CompanyValidator $validator) {
        parent::__construct($repository, $validator);

        View::share('titlePage', __('company.page_title'));
        View::share('headerPage', 'company.page_header');
    }
}
