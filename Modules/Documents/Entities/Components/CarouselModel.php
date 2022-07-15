<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class CarouselModel extends BaseDocsModel
{
    protected $table = 'carousel';

    protected $parentTable = 'components';

    protected $fillable = [];
}
