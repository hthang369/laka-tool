<?php

namespace Modules\Home\Entities\Versions;

use Laka\Core\Entities\BaseModel;

class VersionModel extends BaseModel
{
    protected $table = 'version';

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
