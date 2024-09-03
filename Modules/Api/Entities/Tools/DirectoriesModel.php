<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class DirectoriesModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'directories';

    protected $fillable = ['id', 'path'];
}
