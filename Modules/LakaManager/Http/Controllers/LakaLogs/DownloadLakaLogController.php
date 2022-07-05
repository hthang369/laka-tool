<?php

namespace Modules\LakaManager\Http\Controllers\LakaLogs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\LakaLogs\DownloadLakaLogRepository;
use Modules\LakaManager\Validators\LakaLogs\DownloadLakaLogValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class DownloadLakaLogController extends CoreController
{
    protected $defaultName = 'laka-log';

    protected $listViewName = [
        'index'     => 'lakamanager::laka-log.parse-log',
    ];

    public function __construct(DownloadLakaLogRepository $repository, DownloadLakaLogValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        View::share('titlePage', __('laka_log.page_title'));
        View::share('headerPage', 'laka_log.page_header');
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
