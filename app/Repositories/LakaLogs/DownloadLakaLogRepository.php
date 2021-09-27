<?php

namespace App\Repositories\LakaLogs;

use App\Models\LakaLogs\DownloadLakaLog;
use App\Presenters\LakaLogs\DownloadLakaLogGridPresenter;
use App\Repositories\Core\CoreRepository;
use Illuminate\Support\Facades\Storage;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class DownloadLakaLogRepository extends CoreRepository
{
    protected $modelClass = DownloadLakaLog::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $storage;

    public function __construct()
    {
        parent::__construct();

        $this->storage = Storage::disk('s3');
    }

    protected $presenterClass = DownloadLakaLogGridPresenter::class;

    public function downloadLog($name) : bool {
        return Storage::disk('local')->put(
            'public/files/' . $name,
            file_get_contents($this->storage->get($name))
        );
    }
}
