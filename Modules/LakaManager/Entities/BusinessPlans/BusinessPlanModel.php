<?php

namespace Modules\LakaManager\Entities\BusinessPlans;

use Laka\Core\Entities\BaseModel;

class BusinessPlanModel extends BaseModel
{
    protected $table = 'business_plan';

    protected $fillable = ['name', 'description'];

    protected $fillableColumns = [
        'id',
        'name',
        'description',
    ];
}
