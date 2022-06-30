<?php

namespace Modules\LakaManager\Repositories\Companys;

use Modules\LakaManager\Entities\Companys\CompanyModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\LakaManager\Forms\Companys\CompanyForm;
use Modules\LakaManager\Grids\Companys\CompanyGrid;

class CompanyRepository extends CoreRepository
{
    protected $presenterClass = CompanyGrid::class;

    protected $modelClass = CompanyModel::class;

    public function form()
    {
        return CompanyForm::class;
    }
}
