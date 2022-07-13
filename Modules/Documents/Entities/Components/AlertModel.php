<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class AlertModel extends BaseDocsModel
{
    protected $table = 'alerts';

    protected $parentTable = 'components';

    protected $fillable = [];
}
