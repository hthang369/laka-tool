<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;

class QueryExceptionHandler
{
    /**
     * We use a lot of database queries in __construct(),
     * so it will fail if our app has just been initialized and has an empty database,
     * and we can't even run artisan:migrate command to migrate our database
     *
     * This function tries to solve that issue by checking if "migrations" table exists.
     * If it isn't, meaning we are in new state, those QueryException should be ignored,
     * so we can migrate our database
     *
     * @param QueryException $exception
     */
    public static function continueOrStop(QueryException $exception)
    {
        if (!\App::runningInConsole()) {
            throw $exception;
        }

        if (\Schema::hasTable('migrations')) {
            throw $exception;
        }
    }
}
