<?php

namespace App\Jobs;

use App\Events\DemoNotificationEvent;
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
    public function handle()
    {
        event(new DemoNotificationEvent(true, 'Starting download'));

        Common::callApi('get', 'http://lfm-demo.com/api/v1/download-data');

        event(new DemoNotificationEvent(false, 'Ending download'));
    }
}
