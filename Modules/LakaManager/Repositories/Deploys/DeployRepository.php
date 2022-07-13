<?php

namespace Modules\LakaManager\Repositories\Deploys;

use Modules\LakaManager\Entities\Deploys\DeployModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\LakaManager\Forms\Deploys\DeployVersionForm;
use Modules\LakaManager\Repositories\LogReleases\LogReleaseRepository;
use Modules\LakaManager\Services\Deploys\DeployService;

class DeployRepository extends CoreRepository
{
    protected $modelClass = DeployModel::class;

    protected $logRepository;
    protected $service;

    public function __construct(LogReleaseRepository $logReleaseRepository, DeployService $service)
    {
        parent::__construct();
        $this->logRepository = $logReleaseRepository;
        $this->service = $service;
    }

    public function form()
    {
        return DeployVersionForm::class;
    }

    public function show($environment, $columns = [])
    {
        $serverArray = collect();
        foreach (config("laka.deploy.list_environment.{$environment}") as $server => $value) {
            $deployServer = new DeployModel();
            $version = DeployModel::getVersion($server, $environment);
            if ($version == null) {
                $deployServer->setVersion(null);
            } else {
                $deployServer->setVersion($version);
            }

            $deployServer->setServer($server);

            $serverArray->push($deployServer);
        }

        return $this->parserResult(['serverArray' => array_group_by_single($serverArray, 'server')->toArray(), 'environment' => $environment]);
    }

    public function doDeploy($attributes)
    {
        $this->logRepository->create($attributes);
        extract($attributes);
        return $this->service->doDeploy($environment, $server, $deploy_version);
    }
}
