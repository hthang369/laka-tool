<?php

namespace Modules\LakaManager\Repositories\LakaLogs;

use Modules\LakaManager\Repositories\LakaLogs\DownloadLakaLogRepository;
use Modules\LakaManager\Repositories\LakaLogs\Filters\WhereDateClause;
use Illuminate\Support\Facades\Storage;
use Modules\LakaManager\Entities\LakaLogs\AwsS3LogModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\Common\Repositories\BaseClientCriteria;
use Modules\Common\Repositories\Filters\SortByClientClause;
use Modules\Common\Repositories\Filters\WhereLikeClientClause;
use Modules\LakaManager\Grids\LakaLogs\AwsS3LogGrid;

class AwsS3LogRepository extends CoreRepository
{
    use BaseClientCriteria;

    protected $presenterClass = AwsS3LogGrid::class;

    protected $modelClass = AwsS3LogModel::class;
    protected $storage;

    protected $filters = [
        'sort' => SortByClientClause::class,
        'date' => WhereDateClause::class,
        'name' => WhereLikeClientClause::class
    ];

    public function __construct()
    {
        parent::__construct();
        $this->storage = Storage::disk('s3');
    }

    protected function paginateData($data = null, $method = "paginate", $limit = null, $columns = [])
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

        return parent::paginateData($this->filterByRequest($results), 'paginateClient', $limit, $columns);
    }
}
