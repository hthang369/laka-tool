<?php

namespace Modules\Documents\Repositories;

use Laka\Core\Components\Common\Alert;
use Modules\Documents\Entities\DocumentsModel;
use Modules\Documents\Grids\DocumentsGrid;
use Laka\Core\Repositories\CoreRepository;
use phpDocumentor\Reflection\DocBlockFactory;

class DocumentsRepository extends CoreRepository
{
    protected $presenterClass = DocumentsGrid::class;

    protected $modelClass = DocumentsModel::class;

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        $factory = DocBlockFactory::createInstance();
        $listData = collect(config('documents.menus'));
        $listData->transform(function($item) use($factory) {
            array_walk($item['children'], function(&$subItem) use($factory) {
                if (array_key_exists('component', $subItem)) {
                    $coms = array_wrap($subItem['component']);
                    $reflector = new \ReflectionClass(head($coms));
                    $docComment = $reflector->getDocComment();
                    if ($docComment) {
                        $docBlock = $factory->create($docComment);
                        data_set($subItem, 'summary', $docBlock->getSummary());
                    }
                }
                return $subItem;
            });
            return $item;
        });
        // dd($listData);
        // $docComment = $reflector->getMethod('__construct')->getDocComment();
        // $docBlock = $factory->create($docComment);
        // dd($docBlock);

        return $listData;
    }
}
