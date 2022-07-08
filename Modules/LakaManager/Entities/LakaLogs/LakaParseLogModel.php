<?php

namespace Modules\LakaManager\Entities\LakaLogs;

use Laka\Core\Entities\BaseModel;

class LakaParseLogModel extends BaseModel
{
    protected $table = 'download_laka_log';

    protected $fillable = ['name','status'];

    protected $fillableColumns = [
        'id',
        'name',
        'status'
    ];
}
