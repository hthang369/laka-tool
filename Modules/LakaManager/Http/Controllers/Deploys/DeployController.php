<?php

namespace Modules\LakaManager\Http\Controllers\Deploys;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\Deploys\DeployRepository;
use Modules\LakaManager\Validators\Deploys\DeployValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class DeployController extends CoreController
{
    protected $defaultName = 'deploy';

    protected $routeName = 'version-deploy';

    public function __construct(DeployRepository $repository, DeployValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('deploy_version.page_title'));
        View::share('headerPage', __('deploy_version.page_header'));
    }

    public function index(Request $request)
    {
        $base = $this->repository->show(last(request()->segments()));
        list($modal, $form) = $this->formGenerateConfig(route($this->routeName.'.deploy'), __FUNCTION__, ['method' => 'put', 'model' => $base]);

        return $this->responseView($request, compact('modal', 'form'), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function doDeploy(Request $request)
    {
        $environment = $request->get('environment');
        $routeName = route("deploy-{$environment}.{$environment}");

        try {
            $this->validator($request->all(), ValidatorInterface::RULE_UPDATE);

            list($status, $message) = $this->repository->doDeploy($request->all());
            $method = $status ? 'created' : 'error';

            return $this->responseAction($request, null, $method, $routeName, $message);
        } catch (ValidatorException $ex) {
            return $this->responseAction($request, null, 'validationError', $routeName, '', $ex->getMessageBag()->messages());
        }
    }
}
