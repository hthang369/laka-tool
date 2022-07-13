<?php

namespace Modules\LakaManager\Repositories\LakaLogs;

use Illuminate\Support\Facades\Storage;
use Modules\LakaManager\Entities\LakaLogs\LakaLogModel;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Modules\Common\Repositories\Filters\WhereBetweenClause;
use Modules\LakaManager\Forms\LakaLogs\LakaLogForm;
use Modules\LakaManager\Grids\LakaLogs\LakaLogGrid;

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
    protected $storage;

    public function __construct()
    {
        parent::__construct();
        $this->storage = Storage::disk('s3');
    }

    public function form()
    {
        return LakaLogForm::class;
    }
}
