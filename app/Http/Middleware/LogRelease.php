<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\LakaManager\Repositories\LogReleases\LogReleaseRepository;

class LogRelease
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    private $logReleaseRepository;

    public function __construct(LogReleaseRepository $logReleaseRepository)
    {
        $this->logReleaseRepository = $logReleaseRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $attributes = $request->all();
        $this->logReleaseRepository->create($attributes);

        return $next($request);
    }
}
