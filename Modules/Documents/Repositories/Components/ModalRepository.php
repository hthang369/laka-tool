<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\ModalModel;
use Modules\Documents\Grids\Components\ModalGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class ModalRepository extends BaseDocsRepository
{
    protected $presenterClass = ModalGrid::class;

    protected $modelClass = ModalModel::class;
}
