<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class ConfigPathsModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'config_paths';

    protected $fillable = ['os_id', 'cfg_id', 'path'];

    public function osys()
    {
        return $this->belongsTo(OsysModel::class, 'os_id');
    }
}
