<?php

namespace Modules\LakaManager\Http\Controllers\LakaLogs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\LakaLogs\AwsS3LogRepository;
use Modules\LakaManager\Validators\LakaLogs\AwsS3LogValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class AwsS3LogController extends CoreController
{
    protected $defaultName = 'laka-log';

    protected $listViewName = [
        'index'     => 'lakamanager::laka-log.s3-log-list',
    ];

    public function __construct(AwsS3LogRepository $repository, AwsS3LogValidator $validator, BaseResponse $response)
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
            request()->merge(['date' => ['start' => $dtFrom, 'end' => $dtTo]]);
        }
        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);

        return parent::index($request);
    }

    public function downloadLog(Request $request)
    {
        // find record and create record
        $this->repository->updateOrCreate($request->only('name'));

        // download file to project folder
        $data = $this->repository->downloadLog(request('name'));

        return $this->responseAction($request, $data, 'data', '', translate('response.downloaded'));
    }
}
