<?php

namespace Modules\LakaManager\Http\Controllers\LogReleases;

use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\LogReleases\LogReleaseRepository;
use Modules\LakaManager\Validators\LogReleases\LogReleaseValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class LogReleaseController extends CoreController
{
    protected $defaultName = 'log-releases';

    public function __construct(LogReleaseRepository $repository, LogReleaseValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('deploy_version.page_title'));
        View::share('headerPage', 'deploy_version.log_release.page_header');
    }
}
