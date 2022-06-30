<?php

namespace Modules\LakaManager\Entities\RepairDatas;

use Laka\Core\Entities\BaseModel;

class RepairDataModel extends BaseModel
{
    protected $table = 'repair_data';

    protected $fillable = ['name', 'path', 'size', 'status'];

    protected $fillableColumns = [
        'id',
        'name',
        'path',
        'status',
        'created_at'
    ];
}
