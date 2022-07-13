<?php

namespace Modules\Common\Entities\LogActivitys;

use Laka\Core\Entities\BaseModel;

class LogActivity extends BaseModel
{
    protected $table = 'log_activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id', 'user_name', 'input'
    ];

    protected $fillableColumns = [
        'id',
        'subject', 'url', 'method', 'ip', 'agent', 'user_id', 'user_name', 'input'
    ];
}
