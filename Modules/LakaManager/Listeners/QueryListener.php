<?php
namespace Modules\LakaManager\Listeners;

use Laka\Core\Support\QueryLogger;
use Illuminate\Database\Events\QueryExecuted;

class QueryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        // if (preg_match('/^insert|update|delete/', $event->sql)) {
            // QueryLogger::log($event);
        // }
    }
}
