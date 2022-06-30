<?php

namespace Modules\LakaManager\Jobs;

use Modules\LakaManager\Events\DownloadDataNotificationEvent;
use Modules\LakaManager\Facades\Common;
use Modules\LakaManager\Repositories\RepairDatas\RepairDataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        event(new DownloadDataNotificationEvent(true, 'Starting download', $this->id));

        $file = Common::downloadFileToAws('s3_repair', $this->name, 'path_repair', false);
        if (PHP_OS != 'Linux') {
            $file = str_replace('/', '\\', $file);
        }
        $localFile = public_path($file);
        if (file_exists($localFile)) {
            $repository->update(['status' => 1], $this->id);
        }

        event(new DownloadDataNotificationEvent(false, 'Ending download', $this->id));
    }
}
