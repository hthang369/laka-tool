<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class ConfigsModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'configs';

    protected $fillable = ['type', 'key', 'value'];

    protected $casts = [
        'value' => 'array'
    ];

    public function config_path()
    {
        return $this->hasMany(ConfigPathsModel::class, 'cfg_id');
    }
}
