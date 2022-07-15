<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class CardModel extends BaseDocsModel
{
    protected $table = 'card';

    protected $parentTable = 'components';

    protected $fillable = [];
}
