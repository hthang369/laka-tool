<?php

namespace Modules\Api\Entities\Windmill;

class Template extends WindmillModel
{
    protected $table = 'template';

    protected $fillable = [
        'name',
        'description',
        'platform',
        'channel',
        'target',
        'target_for',
        'created_by',
        'created_email',
        'updated_by',
        'updated_email',
        'status',
    ];
}
