<?php

namespace App\Jobs;

use App\Events\DemoNotificationEvent;
use App\Repositories\RepairDatas\RepairDataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laka\Core\Facades\Common;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RepairDataRepository $repository)
    {
        event(new DemoNotificationEvent(true, 'Starting download'));

        $result = Common::callApi('get', 'http://lfm-demo.com/api/v1/download-data');
        if (data_get($result, 'success')) {
            $repository->create(['name' => data_get($result, 'data.file_name'), 'status' => 0]);
        }

        event(new DemoNotificationEvent(false, 'Ending download'));
    }
}
