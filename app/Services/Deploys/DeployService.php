<?php

namespace App\Services\Deploys;

use Laka\Lib\Services\LakaDeploy;

class DeployService
{
    public function doDeploy($environment, $server, $version)
    {
        // todo: gọi api lên server để Deploy
        // $result = LakaDeploy::Deploy(
        //     $server,
        //     $environment,
        //     $version
        // );

        $status = true; //$result[$environment]['status'];
        $message = 'deploy success!'; //$result[$environment]['data']->return[0];

        return [$status, $message];
    }
}
