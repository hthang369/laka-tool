<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class BadgeModel extends BaseDocsModel
{
    protected $table = 'badge';

    protected $parentTable = 'components';

    protected $fillable = [];
}
