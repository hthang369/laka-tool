<?php

namespace Modules\Documents\Repositories\Components;

use Modules\Documents\Entities\Components\EmbedModel;
use Modules\Documents\Grids\Components\EmbedGrid;
use Modules\Documents\Repositories\BaseDocsRepository;

class EmbedRepository extends BaseDocsRepository
{
    protected $presenterClass = EmbedGrid::class;

    protected $modelClass = EmbedModel::class;
}
