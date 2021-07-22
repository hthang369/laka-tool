<?php

namespace App\Models\LogReleases;

use App\Core\Entities\BaseModel;

class LogRelease extends BaseModel
{
    protected $table = 'log_releases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','user_name','deploy_server_id', 'redmine_id', 'version', 'release_type','environment'
    ];

    protected $fillableColumns = [
        'id',
        'user_id',
        'user_name',
        'deploy_server_id',
        'redmine_id',
        'version',
        'release_type',
        'environment'
    ];
}
