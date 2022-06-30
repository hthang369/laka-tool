<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Modules\Common\Services\Menu\MenuService;

class CheckPermissionByRole
{

    private $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return abort(403);
        }

        Schema::defaultStringLength(191);
        $menus = $this->menuService->getMenuByPermission();
        View::share(['MENUS' => $menus]);

        return $next($request);
    }
}
