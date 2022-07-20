<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class HeadlineModel extends BaseDocsModel
{
    protected $table = 'headline';

    protected $parentTable = 'components';

    protected $fillable = [];
}
