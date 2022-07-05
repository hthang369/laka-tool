<?php

namespace Modules\LakaManager\Repositories\LakaLogs;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\LakaManager\Entities\LakaLogs\LakaLogModel;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Modules\Common\Repositories\Filters\WhereBetweenClause;
use Modules\LakaManager\Forms\LakaLogs\LakaLogForm;
use Modules\LakaManager\Grids\LakaLogs\LakaLogGrid;
use Modules\LakaManager\Helpers\HttpLogParser;
use Modules\LakaManager\Helpers\LogParser;

class LakaLogRepository extends CoreRepository
{
    protected $presenterClass = LakaLogGrid::class;

    protected $modelClass = LakaLogModel::class;

    protected $filters = [
        'name' => WhereClause::class,
        'date_log' => WhereBetweenClause::class,
        'log_level' => WhereLikeClause::class,
        'ip' => WhereLikeClause::class,
        'url' => WhereLikeClause::class
    ];

    protected $except = ['date_log'];
    protected $downLoadLogLakaRepository;
    protected $storage;

    public function __construct(DownloadLakaLogRepository $downloadLakaLogRepository)
    {
        parent::__construct();
        $this->downLoadLogLakaRepository = $downloadLakaLogRepository;
        $this->storage = Storage::disk('s3');
    }

    public function form()
    {
        return LakaLogForm::class;
    }

    public function create(array $attributes)
    {
        $files = $attributes['files'];
        foreach ($files as  $file) {
            // Get data of file from TABLE 'download_laka_log'
            $fileDownloaded = $this->downLoadLogLakaRepository->findByField('name', $file)->first();

            //Check file exist and file not parse
            if ($fileDownloaded && $fileDownloaded->status == false) {
                $dataLog = [];
                $data = [];

                if (starts_with($file, 'laravel')) {
                    $data = LogParser::parse($this->storage->get($file));
                    $data = array_map(function ($item) {
                        $item['date_log'] = LogParser::extractDateTime($item['header']);
                        return [
                            'ip' => request()->ip(),
                            'url' => '',
                            'date_log' => $item['date_log'],
                            'message' => $item['header'],
                            'log_level' => $item['level'],
                            'log_type' => 'laravel',
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }, $data);
                } else {
                    $result = explode('<br />', nl2br($this->storage->get(DIRECTORY_SEPARATOR . $file)));
                    // $result = file(storage_path('logs'.DIRECTORY_SEPARATOR.$file), FILE_IGNORE_NEW_LINES);
                    foreach ($result as $line) {
                        if (blank(trim($line))) continue;
                        $envroment = starts_with($file, 'real') ? 'real' : 'stg';
                        $item = array_merge(HttpLogParser::parse(trim($line)), [
                            'log_level' => 'laka_' . $envroment,
                            'log_type' => 'apache',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        array_push($data, $item);
                    }
                    $dataLog = array_merge($dataLog, $data);
                }
            }

            // Save data log to TABLE 'laka-log'
            // Change status from not parse to parsed and save to DB of file
            if ($dataLog != null) {
                DB::transaction(function () use($dataLog, $fileDownloaded) {
                    $this->model::insert($dataLog);

                    // Change status from not parse to parsed and save to DB of file
                    $fileDownloaded->status = true;
                    $fileDownloaded->save();
                });
            }
        };

        return;

    }
}
