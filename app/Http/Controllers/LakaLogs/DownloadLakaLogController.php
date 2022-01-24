<?php

namespace App\Http\Controllers\LakaLogs;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaLogs\DownloadLakaLogRepository;
use App\Validators\LakaLogs\DownloadLakaLogValidator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\JsonResponse;
use Laka\Core\Http\Response\WebResponse;

/**
 * Class DownloadLakaLogController
 * @package App\Http\Controllers\DownloadLakaLogs
 * @property DownloadLakaLogRepository downloadlakalogRepository
 */
class DownloadLakaLogController extends CoreController
{
    protected $permissionActions = [
        'downloadLog' => 'download'
    ];

    protected $listViewName = [
        'index' => 'laka-log.create'
    ];

    public function __construct(DownloadLakaLogRepository $repository, DownloadLakaLogValidator $validator) {
        parent::__construct($repository, $validator);
        View::share('titlePage', __('laka_log.page_title'));
        View::share('headerPage', 'laka_log.page_header');
    }

    public function downloadLog()  {
        // find record
        $downloadLakaLog = $this->repository->findByField('name', request('name'))[0];
        // record exist
        if($downloadLakaLog) {
            // update updated_at column
            $downloadLakaLog->updated_at = Carbon::now();
            $downloadLakaLog->save();
        }
        // record not exist
        else
        {
            // create new record
            $this->repository->create(request()->except('_token'));
        }

        // download file to project folder
        $data = $this->repository->downloadLog(request('name'));

        return JsonResponse::success($data, translate('response.downloaded'));

    }
}
