<?php

namespace Modules\LakaManager\Repositories\LakaLogs;

use Illuminate\Support\Facades\Storage;
use Modules\LakaManager\Entities\LakaLogs\DownloadLakaLogModel;
use Laka\Core\Repositories\CoreRepository;
use Modules\LakaManager\Grids\LakaLogs\DownloadLakaLogGrid;

class DownloadLakaLogRepository extends CoreRepository
{
    protected $presenterClass = DownloadLakaLogGrid::class;

    protected $modelClass = DownloadLakaLogModel::class;

    protected $filters = [
        'name' => WhereLikeClause::class
    ];

    protected $storage;

    public function __construct()
    {
        parent::__construct();

        $this->storage = Storage::disk('s3');
    }

    public function downloadLog($name)
    {
        Storage::disk('local')->put(
            'public/files/' . $name,
            $this->storage->get($name)
        );

        return env('APP_URL').Storage::disk('local')->url('public/files/' . $name);
    }
}
