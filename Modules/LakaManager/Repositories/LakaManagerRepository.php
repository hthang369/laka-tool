<?php

namespace Modules\LakaManager\Repositories;

use Modules\LakaManager\Entities\LakaManagerModel;
use Laka\Core\Repositories\CoreRepository;

class LakaManagerRepository extends CoreRepository
{
    protected $presenterClass = LakaManagerGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LakaManagerModel::class;
    }
}
