<?php

namespace Modules\LakaManager\Http\Controllers\LakaLogs;

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
    }
}
