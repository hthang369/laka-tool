<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class ServersModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'servers';

    protected $fillable = ['id', 'name', 'service_id', 'host_name', 'user_name', 'password', 'description'];

    public function service()
    {
        return $this->belongsTo(ServicesModel::class);
    }
}
