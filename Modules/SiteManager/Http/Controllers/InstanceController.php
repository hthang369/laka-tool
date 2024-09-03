<?php

namespace Modules\SiteManager\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SiteManager\Repositories\InstanceRepository;
use Modules\SiteManager\Validators\InstanceValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Api\Repositories\ServersRepository;

class InstanceController extends CoreController
{
    protected $listViewName = [
        'index'     => 'sitemanager::instances.list',
    ];

    public function __construct(InstanceRepository $repository, InstanceValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function start(Request $request, $name)
    {
        return resolve(ServersRepository::class)->execActionService(__FUNCTION__, $name);
    }

    public function stop(Request $request, $name)
    {
        return resolve(ServersRepository::class)->execActionService(__FUNCTION__, $name);
    }

    public function restart(Request $request, $name)
    {
        return resolve(ServersRepository::class)->execActionService(__FUNCTION__, $name);
    }
}
