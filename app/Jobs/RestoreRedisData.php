<?php

namespace App\Jobs;

use App\Facades\Common;
use App\Repositories\RepairDatas\RepairDataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;

class RestoreRedisData implements ShouldQueue
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
        $file = Common::getFullPathFileName($this->name, 'path_repair');
        $commands = config('laka.repair-data.command.restore');
        $fullPath = str_replace([':', '\\'], ['', '/'], public_path(str_replace('/', '\\', $file)));
        $commands = array_map(function($command) use($fullPath) {
            return str_replace(
                    [':path', ':filename', ':path_root', ':redis_folder'],
                    [strtolower(pathinfo($fullPath, PATHINFO_DIRNAME)), pathinfo($fullPath, PATHINFO_BASENAME), env('PATH_ROOT'), env('REDIS_FOLDER')],
                $command);
        }, $commands);
        try {
            foreach($commands as $command) {
                $process = Process::fromShellCommandline($command);
                $process->mustRun();
            }

            $repository->update(['status' => 2], $this->id);
        } catch(\Exception $ex) {
        }
    }
}
