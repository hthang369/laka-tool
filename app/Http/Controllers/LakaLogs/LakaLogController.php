<?php

namespace App\Http\Controllers\LakaLogs;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaLogs\LakaLogRepository;
use App\Repositories\DownloadLakaLogs\DownloadLakaLogRepository;
use App\Services\LakaLogs\LakaLogService;
use App\Validators\LakaLogs\LakaLogValidator;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\WebResponse;

/**
 * Class LakaLogController
 * @package App\Http\Controllers\LakaLogs
 * @property LakaLogRepository lakalogRepository
 */
class LakaLogController extends CoreController
{
    public $downloadLakaLogRepository;

    public $lakaLogService;

    protected $listViewName = [
        'index' => 'laka-log.list',
        'create' => 'laka-log.create',
        'store' => 'laka-log.create',
        'show' => 'laka-log.detail',
        's3LogList' => 'laka-log.s3-log-list'
    ];

    public function __construct(LakaLogValidator $validator) { 
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(LakaLogRepository::class);
        $this->downloadLakaLogRepository = $this->factory->makeRepository(DownloadLakaLogRepository::class);
        $this->lakaLogService = new LakaLogService();

        View::share('titlePage', 'laka_log.page_title');
        View::share('headerPage', 'laka_log.page_header');
    }

    public function index() {
        $now = today();
        $dtFrom = request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
        $dtTo = request('dtTo', $now->clone()->lastOfMonth()->toDateString());
        if ($dtFrom && $dtTo) {
            request()->merge(['date_log' => ['start' => $dtFrom, 'end' => $dtTo]]);
        }
        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);
        return parent::index();
    }

    public function s3LogList() {
        $now = today();
        // if session for dtFrom and dtTo exist
        if(session('s3DtFrom') || session('s3DtTo')) {
            $dtFrom = session('s3DtFrom') != null ? request('dtFrom', session('s3DtFrom')) : request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
            $dtTo = session('s3DtTo') != null ? request('dtTo', session('s3DtTo')) : request('dtTo', $now->clone()->firstOfMonth()->toDateString());
        }
        else {
            $dtFrom = request('dtFrom', $now->clone()->firstOfMonth()->toDateString());
            $dtTo = request('dtTo', $now->clone()->lastOfMonth()->toDateString());
        }

        // handle variables
        if ($dtFrom && $dtTo) {
            request()->merge(['date_log' => ['start' => $dtFrom, 'end' => $dtTo]]);
        }
        View::share('dtFrom', $dtFrom);
        View::share('dtTo', $dtTo);
        session([
            's3DtFrom' => $dtFrom,
            's3DtTo' => $dtTo
        ]);

        // get files list
        $files = collect($this->repository->formGenerate()['files']);

        // filter files by date
        $files = $this->lakaLogService->filesFilterByDate($files, $dtFrom, $dtTo);
       
        // paginate
        $paginator = $this->repository->filesPaginate($files, request('page')); 

        // check if user has already downloaded file
        foreach ($paginator as $key => $value) {
            $downloadLakaLog = $this->downloadLakaLogRepository->findByField('name', $value)->toArray()[0];

            $paginator[$key] = [
                'name' => $value,
                'isDownloaded' => $downloadLakaLog != null,
            ];
        }

        return WebResponse::success($this->getViewName(__FUNCTION__), ['paginator' => $paginator]);
    }
}
