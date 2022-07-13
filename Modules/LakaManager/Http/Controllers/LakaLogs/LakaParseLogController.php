<?php

namespace Modules\LakaManager\Http\Controllers\LakaLogs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\LakaManager\Repositories\LakaLogs\LakaParseLogRepository;
use Modules\LakaManager\Validators\LakaLogs\LakaParseLogValidator;

class LakaParseLogController extends CoreController
{
    protected $defaultName = 'laka-log';

    protected $listViewName = [
        'index'     => 'lakamanager::laka-log.parse-log',
    ];

    public function __construct(LakaParseLogRepository $repository, LakaParseLogValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        View::share('titlePage', __('laka_log.page_title'));
        View::share('headerPage', 'laka_log.page_header');
    }
}
