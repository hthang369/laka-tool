<?php

namespace App\Models\RepairDatas;

use Laka\Core\Entities\BaseModel;

class RepairData extends BaseModel
{
    protected $table = 'repairdata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status'
    ];

    protected $fillableColumns = [
        'id',
        'name',
        'description',
        'status'
    ];
}
