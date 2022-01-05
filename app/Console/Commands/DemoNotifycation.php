<?php

namespace App\Console\Commands;

use App\Events\DemoNotificationEvent;
use Illuminate\Console\Command;
use Pusher\Pusher;
use Symfony\Component\Console\Helper\ProgressBar;

class DemoNotifycation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lfm-progress:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting progress');
        event(new DemoNotificationEvent(true, 'Starting progress'));
        $progress = new ProgressBar($this->output, 1000);
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     ['cluster' => env('PUSHER_APP_CLUSTER'),
        //     'encrypted' => true]
        // );

        $progress->start();
        for ($i = 1; $i <= 1000; $i++) {
            event(new DemoNotificationEvent(true, ($i * 100) / 1000));
            // $pusher->trigger('channel-demo', 'App\\Events\\DemoNotificationEvent', ($i * 100) / 1000);
            $progress->advance();
            usleep(500000);
        }
        $progress->finish();
        event(new DemoNotificationEvent(false, 'Ending progress'));
        $this->info('Ending progress');
        return Command::SUCCESS;
    }
}
