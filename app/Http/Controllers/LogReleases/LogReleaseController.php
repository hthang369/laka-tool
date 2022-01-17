<?php

namespace App\Http\Controllers\LogReleases;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LogReleases\LogReleaseRepository;
use App\Validators\LogReleases\LogReleaseValidator;
use Illuminate\Support\Facades\View;

/**
 * Class LogReleaseController
 * @package App\Http\Controllers\LogReleases
 * @property LogReleaseRepository logreleaseRepository
 */
class LogReleaseController extends CoreController
{
    protected $listViewName = [
        'index' => 'logs-release.list'
    ];

    public function __construct(LogReleaseRepository $repository, LogReleaseValidator $validator) {
        parent::__construct($repository, $validator);

        View::share('titlePage', __('deploy_version.page_title'));
        View::share('headerPage', 'deploy_version.log_release.page_header');
    }
}
