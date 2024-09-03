<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class ServicesModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'services';

    protected $fillable = ['id', 'type', 'name'];

    public function servers()
    {
        return $this->hasMany(ServersModel::class, "service_id");
    }
}
