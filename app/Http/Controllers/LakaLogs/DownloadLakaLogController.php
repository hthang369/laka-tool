<?php

namespace App\Http\Controllers\LakaLogs;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaLogs\DownloadLakaLogRepository;
use App\Validators\LakaLogs\DownloadLakaLogValidator;
use Illuminate\Support\Carbon;
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

    protected $listViewName = [];

    public function __construct(DownloadLakaLogValidator $validator) {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(DownloadLakaLogRepository::class);
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
        $this->repository->downloadLog(request('name'));

        return WebResponse::downloaded(route('laka-log.s3-log-list'));

    }
}
