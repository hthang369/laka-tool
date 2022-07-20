<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class ProgressModel extends BaseDocsModel
{
    protected $table = 'progress';

    protected $parentTable = 'components';

    protected $fillable = [];
}
