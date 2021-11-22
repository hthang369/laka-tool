<?php

namespace App\Http\Middleware;

use App\Repositories\LogReleases\LogReleaseRepository;
use Closure;
use Illuminate\Http\Request;

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
