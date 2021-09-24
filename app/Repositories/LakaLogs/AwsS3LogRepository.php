<?php

namespace App\Repositories\LakaLogs;

use App\Models\LakaLogs\AwsS3Log;
use App\Presenters\LakaLogs\AwsS3LogGridPresenter;
use App\Repositories\Core\CoreRepository;
use App\Services\LakaLogs\LakaLogService;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Traits\BuildPaginator;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class AwsS3LogRepository extends CoreRepository
{
    use BuildPaginator;

    protected $modelClass = AwsS3Log::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = AwsS3LogGridPresenter::class;
    protected $storage;
    protected $lakaLogService;

    public function __construct()
    {
        parent::__construct();
        $this->storage = Storage::disk('s3');
        $this->lakaLogService = new LakaLogService();
    }

    public function getLogFromS3()
    {
        $listDownloadFile = resolve(DownloadLakaLogRepository::class)->pluck('name');
        $pattern = '/laravel-[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9].log/';
        $files = $this->storage->allFiles(DIRECTORY_SEPARATOR);

        $fileAfterFilters = array_filter($files, function ($file) use ($pattern) {
            return str_contains($file, 'laravel-') || str_contains($file, 'laka-');
        });

        // check if user has already downloaded file
        return array_map(function($file) use($listDownloadFile) {
            return [
                'name' => $file,
                'isDownloaded' => $listDownloadFile->search($file) >= 0
            ];
        }, $fileAfterFilters);
    }

    public function filesPaginate($files, $page)
    {
        $onPage = $this->getLimitForPagination();
        $results = $this->paginator($files->forPage($page, $onPage)->all(), $files->count(), $onPage, $page, []);
        return $this->parserResult($results);
    }
}
