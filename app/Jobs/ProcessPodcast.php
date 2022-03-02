<?php

namespace App\Jobs;

use App\Events\DemoNotificationEvent;
use App\Facades\Common;
use App\Repositories\RepairDatas\RepairDataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RepairDataRepository $repository)
    {
        event(new DemoNotificationEvent(true, 'Starting download', $this->id));

        $file = Common::downloadFileToAws('s3_repair', $this->name, 'path_repair', false);
        $localFile = public_path(str_replace('/', '\\', $file));
        if (file_exists($localFile)) {
            $repository->update(['status' => 1], $this->id);
        }

        event(new DemoNotificationEvent(false, 'Ending download', $this->id));
    }
}
