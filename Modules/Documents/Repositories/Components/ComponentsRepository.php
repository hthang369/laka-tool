<?php

namespace Modules\Documents\Repositories\Components;

use Laka\Core\Facades\PhpDocComment;
use Modules\Documents\Entities\Components\ComponentsModel;
use Modules\Documents\Grids\Components\ComponentsGrid;
use Laka\Core\Repositories\CoreRepository;

class ComponentsRepository extends CoreRepository
{
    protected $presenterClass = ComponentsGrid::class;

    protected $modelClass = ComponentsModel::class;

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        $listData = collect(config('documents.menus'));
        $listData->transform(function($item) {
            array_walk($item['children'], function(&$subItem) {
                if (array_key_exists('component', $subItem)) {
                    $coms = array_wrap($subItem['component']);
                    $summary = PhpDocComment::getPhpDocSummary(head($coms));
                    data_set($subItem, 'summary', $summary);
                }
                return $subItem;
            });
            return $item;
        });

        return $listData;
    }
}
