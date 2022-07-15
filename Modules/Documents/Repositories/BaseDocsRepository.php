<?php

namespace Modules\Documents\Repositories;

use Laka\Core\Facades\PhpDocComment;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Traits\Pagination\BuildPaginator;

class BaseDocsRepository extends CoreRepository
{
    use BuildPaginator;

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        $data = $this->model->getModel()->getAllData();
        $components = array_wrap($data['component']);

        $listComponent = array_map(function($component) {
            $reflector = new \ReflectionClass($component);

            $summary = PhpDocComment::getPhpDocSummary($component);

            $properties = PhpDocComment::getPhpDocProperties($component);

            return [$reflector->getShortName(), $summary, $this->paginator($properties, count($properties), 15, 1, [])];
        }, $components);

        data_set($data, 'grids', data_get($listComponent, '*.0'));
        data_set($data, 'summary', data_get($listComponent, '*.1'));
        data_set($data, 'properties', data_get($listComponent, '*.2'));

        return $data;
    }

    public function allDataGrid()
    {
        $data = $this->paginate();

        $data['grids'] = array_map(function($grid) {
            return $this->makePresenter("Modules\\Documents\\Grids\\Components\\{$grid}Grid");
        }, $data['grids']);

        return [$data['grids'], $data];
    }
}
