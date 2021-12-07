<?php

namespace App\Http\Middleware;

use App\Repositories\Menus\MenuRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class CheckPermissionByRole
{

    private $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
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
        $menu = $this->menuRepo->getAllMenus(Auth::id());
     
        View::share(['TOPMENU' => data_get($menu, 'topMenu'), 'LEFTMENU' => data_get($menu, 'leftMenu')]);

        return $next($request);
    }
}
