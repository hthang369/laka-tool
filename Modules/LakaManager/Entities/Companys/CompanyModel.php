<?php

namespace Modules\LakaManager\Entities\Companys;

use Laka\Core\Entities\BaseModel;

class CompanyModel extends BaseModel
{
    protected $table = 'company';

    protected $fillable = ['name', 'email', 'phone', 'business_plan_id', 'address'];

    protected $fillableColumns = [
        'id',
        'company.name',
        'business_plan_id',
        'email',
        'phone',
        'address'
    ];
}
