<?php

namespace Modules\SystemManager\Http\Controllers\LogActivity;

use Illuminate\Support\Facades\View;
use Modules\SystemManager\Repositories\LogActivity\LogActivityRepository;
use Modules\SystemManager\Validators\LogActivity\LogActivityValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class LogActivityController extends CoreController
{
    public function __construct(LogActivityRepository $repository, LogActivityValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('common.log_activity.page_title'));
        View::share('headerPage', 'common.log_activity.page_header');
    }
}
