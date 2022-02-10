<?php

namespace App\Models\RepairDatas;

use Laka\Core\Entities\BaseModel;

class RepairData extends BaseModel
{
    protected $table = 'repair_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    protected $fillableColumns = [
        'id',
        'name',
        'status',
        'created_at'
    ];
}
