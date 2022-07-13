<?php

namespace Modules\LakaManager\Entities\LakaLogs;

use Laka\Core\Entities\BaseModel;

class LakaLogModel extends BaseModel
{
    protected $table = 'laka_log';

    protected $fillable = ['ip', 'url', 'message', 'date_log', 'log_level', 'log_type'];

    protected $fillableColumns = [
        'id',
        'ip',
        'url',
        'log_level',
        'date_log',
        'message'
    ];
}
