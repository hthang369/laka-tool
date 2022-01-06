<?php

namespace App\Providers;

use Laka\Core\Support\QueryLogger;
use App\Support\CommonHelper;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $initFacades = [
        'common-helper' => CommonHelper::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->initFacades as $key => $class) {
            $this->app->singleton($key, function () use($class) {
                return new $class();
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::connection()->enableQueryLog();
        // DB::listen(function($query) {
        //     QueryLogger::log($query);
        // });
        Queue::before(function(JobProcessing $event) {
            // dump($event->job->resolveName());
            // Log::info($event->job);
        });
        Queue::failing(function (JobFailed $event) {
            // Log::info($event->job);
        });
    }
}
