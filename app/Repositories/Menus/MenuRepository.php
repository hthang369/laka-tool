<?php

namespace App\Repositories\Menus;

use Laka\Core\Repositories\BaseRepository;
use App\Models\Menus\Menus;
use App\Repositories\Sections\SectionRepository;

class MenuRepository extends BaseRepository
{
    protected $modelClass = Menus::class;

    public function getAllMenus($userId)
    {
        $sectionRepo = resolve(SectionRepository::class);
        $listCode = $sectionRepo->getDataByPermissionUserId($userId)->pluck('code')->all();
        $menus = Menus::whereIn('group', $listCode)->defaultOrder()->get()->totree();
        return $menus;
    }
}
