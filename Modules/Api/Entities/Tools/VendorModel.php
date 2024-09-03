<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class VendorModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'vendor';

    protected $fillable = ['title', 'description', 'type', 'logo'];
}
