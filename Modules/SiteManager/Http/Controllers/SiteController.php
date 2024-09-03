<?php

namespace Modules\SiteManager\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SiteManager\Repositories\SiteRepository;
use Modules\SiteManager\Validators\SiteValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class SiteController extends CoreController
{
    // protected $listViewName = [
    //     'index'     => 'sitemanager::sites.list',
    // ];

    public function __construct(SiteRepository $repository, SiteValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
