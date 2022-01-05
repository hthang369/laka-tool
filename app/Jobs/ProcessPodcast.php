<?php

namespace App\Jobs;

use App\Events\DemoNotificationEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        event(new DemoNotificationEvent(true, 'Starting progress'));

        for ($i = 1; $i <= 1000; $i++) {
            event(new DemoNotificationEvent(true, ($i * 100) / 1000));
            // $pusher->trigger('channel-demo', 'App\\Events\\DemoNotificationEvent', ($i * 100) / 1000);
            // $progress->advance();
            sleep(1);
        }
        event(new DemoNotificationEvent(false, 'Ending progress'));
    }
}
