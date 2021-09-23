<?php

namespace App\Repositories\Deploys;

use App\Models\Deploys\Deploy;
use App\Repositories\Core\CoreRepository;
use App\Presenters\Deploys\DeployGridPresenter;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class DeployRepository extends CoreRepository
{
    protected $modelClass = Deploy::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = DeployGridPresenter::class;

    public function paginate($limit = null, $columns = [], $method = "paginate")
    {
        $environment = last(request()->segments());
        $serverArray = [];
        foreach (config("deploy.list_environment.{$environment}") as $server => $value) {
            $deployServer = new Deploy();
            $version = Deploy::getVersion($server, $environment);
            if ($version == null) {
                $deployServer->setVersion(null);
            } else {
                $deployServer->setVersion($version);
            }

            $deployServer->setServer($server);

            $serverArray[] = $deployServer;
        }

        return $this->parserResult(['serverArray' => $serverArray, 'environment' => $environment]);
    }
}
