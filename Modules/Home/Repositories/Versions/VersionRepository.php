<?php

namespace Modules\Home\Repositories\Versions;

use Laka\Core\Repositories\BaseRepository;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Modules\Common\Facades\Common;
use Modules\Home\Entities\Versions\VersionModel;

class VersionRepository extends BaseRepository
{
    protected $modelClass = VersionModel::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    public function paginate($limit = null, $columns = [], $method = "paginate")
    {
        return $this->all();
    }

    public function all($columns = [])
    {
        $json = Common::callApi('get', 'https://laka.lampart-vn.com:9443/api/v1/get-version');
        return ['versions' => $json['data']];
    }
}
