<?php

namespace Modules\LakaManager\Http\Controllers\LakaLogs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\LakaLogs\LakaLogRepository;
use Modules\LakaManager\Validators\LakaLogs\LakaLogValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class LakaLogController extends CoreController
{
    protected $defaultName = 'laka-log';

    protected $messageResponse = [
        'store' => 'laka_log.parsed_success'
    ];

    public function __construct(LakaLogRepository $repository, LakaLogValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('laka_log.page_title'));
        View::share('headerPage', 'laka_log.page_header');
    }

    public function index(Request $request)
    {
        $now = today();
        $dtFrom = request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
        $dtTo = request('dtTo', $now->clone()->lastOfMonth()->toDateString());
        if ($dtFrom && $dtTo) {
            request()->merge(['date_log' => ['start' => $dtFrom, 'end' => $dtTo]]);
        }
        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);
        return parent::index($request);
    }
}
