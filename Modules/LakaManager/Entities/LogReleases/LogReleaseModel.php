<?php

namespace Modules\LakaManager\Entities\LogReleases;

use Laka\Core\Entities\BaseModel;
use Modules\LakaManager\Entities\Deploys\DeployModel;

class LogReleaseModel extends BaseModel
{
    protected $table = 'log_releases';

    protected $fillable = ['user_id','deploy_server_id', 'redmine_id', 'version', 'release_type','environment'];

    protected $fillableColumns = [
        'id',
        'user_id',
        'deploy_server_id',
        'redmine_id',
        'version',
        'release_type',
        'environment'
    ];

    public function deployServer()
    {
        return $this->hasOne(DeployModel::class,'id','deploy_server_id');
    }
}
