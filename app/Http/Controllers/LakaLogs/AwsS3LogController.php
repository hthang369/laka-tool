<?php

namespace App\Http\Controllers\LakaLogs;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaLogs\AwsS3LogRepository;
use App\Services\LakaLogs\LakaLogService;
use App\Validators\LakaLogs\AwsS3LogValidator;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\WebResponse;

/**
 * Class AwsS3LogController
 * @package App\Http\Controllers\AwsS3Logs
 * @property AwsS3LogRepository awss3logRepository
 */
class AwsS3LogController extends CoreController
{
    protected $listViewName = [
        'index'     => 'laka-log.s3-log-list',
    ];

    protected $messageResponse = [
        'store' => 'Parse log success',
    ];

    protected $lakaLogService;

    public function __construct(AwsS3LogRepository $repository, AwsS3LogValidator $validator) {
        parent::__construct($repository, $validator);

        $this->lakaLogService = $this->factory->makeService(LakaLogService::class);

        View::share('titlePage', __('laka_log.page_title'));
        View::share('headerPage', 'laka_log.page_header');
    }

    public function index()
    {
        $now = today();
        $dtFrom = request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
        $dtTo = request('dtTo', $now->clone()->lastOfMonth()->toDateString());
        if ($dtFrom && $dtTo) {
            request()->merge(['date' => ['start' => $dtFrom, 'end' => $dtTo]]);
        }
        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);

        // get files list
        $paginator = $this->repository->getLogFromS3(request('page'));

        return WebResponse::success($this->getViewName(__FUNCTION__), $this->getData($paginator));
    }
}
