<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\CardModel;
use Modules\Documents\Grids\Components\CardGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class CardRepository extends BaseDocsRepository
{
    protected $presenterClass = CardGrid::class;

    protected $modelClass = CardModel::class;
}
