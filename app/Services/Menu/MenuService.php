<?php


namespace App\Services\Menu;


use App\Repositories\Menus\MenuRepository;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    private $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    public function getMenuByPermission()
    {
        $menus = $this->menuRepo->getAllMenus(Auth::id());

        foreach ($menus as $parentKey => $parentMenu) {

            if ($parentMenu->children->count() > 0) {
                foreach ($parentMenu->children as $key => $childMenu) {
                    $splitRouteName = explode('.', $childMenu->route_name);
                    if (in_array('create', $splitRouteName) && !user_can("add_{$childMenu->group}")) {
                        $childMenu->visible = false;
                    } else {
                        $childMenu->visible = true;
                    }
                }
            }
        }

        return $menus;
    }
}
