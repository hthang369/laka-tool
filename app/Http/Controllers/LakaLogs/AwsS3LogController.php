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

    public function __construct(AwsS3LogValidator $validator) {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(AwsS3LogRepository::class);
        $this->lakaLogService = $this->factory->makeService(LakaLogService::class);

        View::share('titlePage', 'laka_log.page_title');
        View::share('headerPage', 'laka_log.page_header');
    }

    public function index()
    {
        $now = today();
        // if session for dtFrom and dtTo exist
        if (session('s3DtFrom') || session('s3DtTo')) {
            $dtFrom = session('s3DtFrom') != null ? request('dtFrom', session('s3DtFrom')) : request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
            $dtTo = session('s3DtTo') != null ? request('dtTo', session('s3DtTo')) : request('dtTo', $now->clone()->firstOfMonth()->toDateString());
        } else {
            $dtFrom = request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
            $dtTo = request('dtTo', $now->clone()->lastOfMonth()->toDateString());
        }

        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);
        session([
            's3DtFrom' => $dtFrom,
            's3DtTo' => $dtTo
        ]);

        // get files list
        $files = collect($this->repository->getLogFromS3());

        // filter files by date
        $files = $this->lakaLogService->filesFilterByDate($files, $dtFrom, $dtTo);
        $files = $this->lakaLogService->filesSortByColumn($files, request('sort'), request('direction'));

        // paginate
        $paginator = $this->repository->filesPaginate($files, request('page'));

        return WebResponse::success($this->getViewName(__FUNCTION__), $paginator);
    }
}
