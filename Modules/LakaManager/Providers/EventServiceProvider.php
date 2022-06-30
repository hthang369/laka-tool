<?php

namespace Modules\LakaManager\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\LakaManager\Events\SendConfirmEmail;
use Modules\LakaManager\Listeners\QueryListener;
use Modules\LakaManager\Listeners\SendConfirmEmailListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        QueryExecuted::class => [
            QueryListener::class,
        ],
        SendConfirmEmail::class => [
            SendConfirmEmailListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
