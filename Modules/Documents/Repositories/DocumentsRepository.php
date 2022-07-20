<?php

namespace Modules\Documents\Repositories;

use FilesystemIterator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
        $trees = new \RecursiveTreeIterator(new \RecursiveDirectoryIterator(dirname(__DIR__), FilesystemIterator::SKIP_DOTS));
        return [['text' => 'documents.docs', 'children' => array_values(array_filter(iterator_to_array($trees), function($fileInfo) {
            return is_dir($fileInfo);
        }, ARRAY_FILTER_USE_KEY))]];
    }
}
