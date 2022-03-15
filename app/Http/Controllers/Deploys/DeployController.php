<?php

namespace App\Http\Controllers\Deploys;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\Deploys\DeployRepository;
use App\Services\Deploys\DeployService;
use App\Validators\Deploys\DeployValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\WebResponse;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class DeployController
 * @package App\Http\Controllers\Deploys
 * @property DeployRepository DeployRepository
 */
class DeployController extends CoreController
{
    protected $permissionActions = [
        'doDeploy' => 'add',
        'index'=>'add',
    ];

    protected $listViewName = [
        'index' => 'deploy.list'
    ];

    protected $service;

    public function __construct(DeployRepository $repository, DeployValidator $validator)
    {
        parent::__construct($repository, $validator);

        $this->service = $this->factory->makeService(DeployService::class);
        View::share('titlePage', __('deploy_version.page_title'));
        View::share('headerPage', __('deploy_version.page_header'));
    }

    public function doDeploy(Request $request)
    {
        $environment = $request->get('environment');
        $routeName = route("version-deploy.{$environment}");
        try {
            $server = $request->get('server');
            $version = $request->get("{$server}_version");

            $this->validator($request->merge(['version' => $version])->except('_token'), ValidatorInterface::RULE_UPDATE);

            list($status, $message) = $this->service->doDeploy($environment, $server, $version);
            $method = $status ? 'created' : 'error';
            return WebResponse::{$method}($routeName, null, $message);
        } catch (ValidatorException $ex) {
            return WebResponse::validateFail($routeName, $ex->getMessageBag());
        }
    }
}
