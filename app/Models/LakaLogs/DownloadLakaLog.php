<?php

namespace App\Models\LakaLogs;

use Laka\Core\Entities\BaseModel;

class DownloadLakaLog extends BaseModel
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
