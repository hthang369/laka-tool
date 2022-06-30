<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laka\Core\Facades\Breadcrumb;
use Modules\Common\Services\LogActivity\LogActivityService;

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
            Breadcrumb::add('<i class="fa fa-home"></i>', url('/'));
            if (!is_null($action)) {
                $text = data_get($action, 'text', $action);
                $parent = data_get($action, 'parent');
                // $subject = user_get('name')." access to: ".trans($action);
            //     $this->logActivityService->addToLog($request, $subject);
                if ($parent) {
                    Breadcrumb::add(trans($parent), '');
                }
                Breadcrumb::add(trans($text), '');
            }
        }

        return $next($request);
    }
}
