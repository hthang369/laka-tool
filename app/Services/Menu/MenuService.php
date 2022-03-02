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
        $menus = $this->menuRepo->getAllMenus(Auth::id())->toArray();

        foreach ($menus as $parentKey => $parentMenu) {
            if (count($parentMenu['children']) > 0) {
                foreach ($parentMenu['children'] as $key => $childMenu) {
                    $splitRouteName = explode('.', $childMenu['route_name']);
                    if (in_array('create', $splitRouteName) && !user_can("add_{$childMenu['group']}")) {
                        $menus[$parentKey]['children'][$key]['visible'] = false;
                    } else {
                        $menus[$parentKey]['children'][$key]['visible'] = true;
                    }

                }
            }
        }
       return collect($menus);
    }
}
