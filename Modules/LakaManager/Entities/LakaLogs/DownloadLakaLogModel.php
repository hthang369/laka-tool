<?php

namespace Modules\LakaManager\Entities\LakaLogs;

use Laka\Core\Entities\BaseModel;

class DownloadLakaLogModel extends BaseModel
{
    protected $table = 'download_laka_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','status'
    ];

    protected $fillableColumns = [
        'id',
        'name',
        'status'
    ];
}
