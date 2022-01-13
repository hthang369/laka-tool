<?php

namespace App\Repositories\LakaLogs;

use App\Models\LakaLogs\AwsS3Log;
use App\Presenters\LakaLogs\AwsS3LogGridPresenter;
use App\Repositories\Core\BaseClientCriteria;
use App\Repositories\Core\CoreRepository;
use App\Repositories\Core\Filters\SortByClientClause;
use App\Repositories\Core\Filters\WhereLikeClientClause;
use App\Repositories\LakaLogs\Filters\WhereDateClause;
use App\Services\LakaLogs\LakaLogService;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Traits\Pagination\BuildPaginator;

class AwsS3LogRepository extends CoreRepository
{
    use BuildPaginator, BaseClientCriteria;

    protected $modelClass = AwsS3Log::class;

    protected $filters = [
        'sort' => SortByClientClause::class,
        'date' => WhereDateClause::class,
        'name' => WhereLikeClientClause::class
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

    public function getLogFromS3($page)
    {
        $listDownloadFile = resolve(DownloadLakaLogRepository::class)->pluck('name')->toArray();
        $pattern = '/(laravel-|laka-)/';
        $files = $this->storage->allFiles(DIRECTORY_SEPARATOR);

        $fileAfterFilters = array_filter($files, function ($file) use ($pattern) {
            return preg_match($pattern, $file);
        });

        // check if user has already downloaded file
        $results = array_map(function($file) use($listDownloadFile) {
            return [
                'name' => $file,
                'isDownloaded' => in_array($file, $listDownloadFile)
            ];
        }, $fileAfterFilters);

        return $this->filesPaginate($this->filterByRequest($results), $page);
    }

    public function filesPaginate($files, $page)
    {
        $onPage = $this->getLimitForPagination();
        $results = $this->paginator($files->forPage($page, $onPage)->all(), $files->count(), $onPage, $page, []);
        $results->appends(request()->query());
        return $this->parserResult($results);
    }
}
