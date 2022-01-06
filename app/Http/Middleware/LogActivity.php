<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\LogActivity\LogActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    private $logActivityService;

    public function __construct(LogActivityService $logActivityService)
    {
        $this->logActivityService = $logActivityService;
    }

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $action = config('constants.'. Route::currentRouteName());
            if (!is_null($action)) {
                $subject = user_get('name')." access to: {$action}";
                $this->logActivityService->addToLog($request, $subject);
            }
        }
        return $next($request);
    }
}
