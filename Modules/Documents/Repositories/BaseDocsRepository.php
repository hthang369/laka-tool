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
        data_set($data, 'summary', PhpDocComment::getPhpDocSummary($data['component']));

        $properties = PhpDocComment::getPhpDocProperties($data['component']);

        return data_set($data, 'properties', $this->paginator($properties, count($properties), 15, 1, []));
    }
}
