<?php

namespace App\Http\Controllers\LakaLogs;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaLogs\LakaLogRepository;
use App\Validators\LakaLogs\LakaLogValidator;
use Illuminate\Support\Facades\View;

/**
 * Class LakaLogController
 * @package App\Http\Controllers\LakaLogs
 * @property LakaLogRepository lakalogRepository
 */
class LakaLogController extends CoreController
{
    protected $permissionActions = [
        'create' => 'view'
    ];

    protected $messageResponse = [
        'store' => 'Parse log success',
    ];
    protected $errorRouteName = [
        'store' => 'laka-log.create'
    ];

    protected $listViewName = [
        'index' => 'laka-log.list',
        'create' => 'laka-log.create',
        'store' => 'laka-log.create',
        'show' => 'laka-log.detail'
    ];

    public function __construct(LakaLogValidator $validator)
    {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(LakaLogRepository::class);

        View::share('titlePage', 'laka_log.page_title');
        View::share('headerPage', 'laka_log.page_header');
    }

    public function index()
    {
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
}
