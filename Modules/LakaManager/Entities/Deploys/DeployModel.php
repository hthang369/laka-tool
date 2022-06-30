<?php

namespace Modules\LakaManager\Entities\Deploys;

use Laka\Core\Entities\BaseModel;
use Laka\Lib\Services\LakaDeploy;

class DeployModel extends BaseModel
{
    protected $table = 'deploy_server';

    protected $fillable = ['name'];

    protected $fillableColumns = [
        'id',
        'name'
    ];

    // public $server;
    // public $version;

    function setVersion($version)
    {
        $this->version = $version;
    }

    function setServer($server)
    {
        $this->server = $server;
    }

    static function getVersion($server, $environment)
    {
        $result = LakaDeploy::getVersion($server, $environment);
        return $result[$environment]->return[0];
    }
}
