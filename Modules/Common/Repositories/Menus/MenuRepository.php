<?php

namespace Modules\Common\Repositories\Menus;

use Laka\Core\Repositories\BaseRepository;
use Modules\Common\Entities\Menus\Menus;
use Modules\Common\Repositories\Sections\SectionRepository;

class MenuRepository extends BaseRepository
{
    protected $modelClass = Menus::class;

    public function getAllMenus($userId)
    {
        $sectionRepo = resolve(SectionRepository::class);
        $listCode = $sectionRepo->getDataByPermissionUserId($userId)->pluck('code')->all();
        $menus = Menus::where(function($query) use($listCode) {
            $query->whereNull('parent_id')
                ->orWhereIn('group', $listCode);
        })->defaultOrder()->get()->totree();
        return $menus;
    }
}
