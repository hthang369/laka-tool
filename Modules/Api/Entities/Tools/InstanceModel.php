<?php

namespace Modules\Api\Entities\Tools;

use Laka\Core\Entities\BaseModel;

class InstanceModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'instances';

    protected $fillable = ['vendor_id', 'name', 'status', 'user', 'path'];

    public function vendor()
    {
        return $this->belongsTo(VendorModel::class);
    }
}
