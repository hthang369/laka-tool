<?php

namespace Modules\SystemManager\Repositories\Routers;

use Laka\Core\Repositories\CoreRepository;
use Modules\Api\Repositories\DBToolRepository;
use Modules\SystemManager\Entities\Routers\RouterModel;
use Modules\SystemManager\Grids\Routers\RouterGrid;

class RouterRepository extends CoreRepository
{
    protected $presenterClass = RouterGrid::class;

    protected $modelClass = RouterModel::class;

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        $params = [
            '@method@' => request('method'),
            '@name@' => request('name'),
            '@path@' => request('uri')
        ];
        $data = resolve(DBToolRepository::class)->execCmd('LARAVEL_ROUTE_LIST', base_path(), $params);
        return parent::paginateData($data, 'paginateClient');
    }
}
