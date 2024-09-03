<?php

namespace Modules\SiteManager\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SiteManager\Repositories\HostRepository;
use Modules\SiteManager\Validators\HostValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class HostController extends CoreController
{
    protected $listViewName = [
        'show'     => 'sitemanager::hosts.list',
    ];

    public function __construct(HostRepository $repository, HostValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function index(Request $request)
    {
        return $this->show($request, 'hosts');
    }
}
