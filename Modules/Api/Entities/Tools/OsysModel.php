<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class OsysModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'osys';

    protected $fillable = ['id', 'name', 'description'];
}
