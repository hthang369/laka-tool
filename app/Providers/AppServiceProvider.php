<?php

namespace App\Providers;

use App\Emails\QueueFailed;
use App\Exceptions\QueryExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $initFacades = [
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

        try {
            $mail_config = config('mail');
            $mail_host = env('MAIL_HOST');
            $mail_port = env('MAIL_PORT');
            $mail_username = env('MAIL_USERNAME');
            $mail_password = env('MAIL_PASSWORD');
            $extra_mail_config = ['host' => $mail_host, 'port' => $mail_port, 'username' => $mail_username, 'password' => $mail_password];
            if (in_array($mail_host, SELF_SIGNED_SMTP_HOSTS)) {
                $allowSelfSigned = [
                    'stream' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer'       => false,
                            'verify_peer_name'  => false,
                        ],
                    ]
                ];
                $extra_mail_config = array_merge($extra_mail_config, $allowSelfSigned);
            }
            config(['mail' => array_merge($mail_config, $extra_mail_config)]);
        } catch (QueryException $exception) {
            QueryExceptionHandler::continueOrStop($exception);
        }

        Queue::before(function(JobProcessing $event) {
            // dump($event->job->resolveName());
            // Log::info($event->job);
        });
        Queue::failing(function (JobFailed $event) {
            $toAddress = config('mail.system_mail');
            if (!$toAddress) {
                Log::info('Queue job failed but not sending mail because system mail address is not configured.');
                return;
            }
            Mail::to($toAddress)
                ->send(new QueueFailed($event));
        });
    }
}
