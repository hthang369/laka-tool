<?php

namespace Modules\Common\Repositories;

use Modules\Common\Entities\CommonModel;
use Laka\Core\Repositories\CoreRepository;

class CommonRepository extends CoreRepository
{
    protected $presenterClass = CommonGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CommonModel::class;
    }
}
