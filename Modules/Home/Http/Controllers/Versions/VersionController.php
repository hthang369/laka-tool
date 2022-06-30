<?php

namespace Modules\Home\Http\Controllers\Versions;

use Laka\Core\Http\Controllers\BaseController;
use Illuminate\Support\Facades\View;
use Laka\Core\Responses\BaseResponse;
use Modules\Home\Repositories\Versions\VersionRepository;
use Modules\Home\Validators\Versions\VersionValidator;

/**
 * Class VersionController
 * @package Modules\Home\Http\Controllers\Versions
 * @property VersionRepository versionRepository
 */
class VersionController extends BaseController
{
    protected $listViewName = [
        'index'     => 'home::version.list'
    ];

    public function __construct(VersionRepository $repository, VersionValidator $validator, BaseResponse $response) {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('version.page_title'));
        View::share('headerPage', 'version.page_header');
    }

}
