<?php

namespace Modules\Api\Entities\Windmill;

use Laka\Core\Entities\BaseModel;

abstract class WindmillModel extends BaseModel
{
    // protected $connection = 'windmill';
    protected $connection = 'mysql';
}
