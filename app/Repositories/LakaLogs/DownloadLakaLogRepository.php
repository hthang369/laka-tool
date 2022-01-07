<?php

namespace App\Repositories\LakaLogs;

use App\Models\LakaLogs\DownloadLakaLog;
use App\Presenters\LakaLogs\DownloadLakaLogGridPresenter;
use App\Repositories\Core\CoreRepository;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;

class DownloadLakaLogRepository extends CoreRepository
{
    protected $modelClass = DownloadLakaLog::class;

    protected $filters = [
        'name' => WhereLikeClause::class
    ];

    protected $storage;

    public function __construct()
    {
        parent::__construct();

        $this->storage = Storage::disk('s3');
    }

    protected $presenterClass = DownloadLakaLogGridPresenter::class;

    public function downloadLog($name)
    {
        Storage::disk('local')->put(
            'public/files/' . $name,
            $this->storage->get($name)
        );

        return env('APP_URL').Storage::disk('local')->url('public/files/' . $name);
    }
}
