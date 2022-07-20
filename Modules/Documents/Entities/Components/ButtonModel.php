<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class ButtonModel extends BaseDocsModel
{
    protected $table = 'button';

    protected $parentTable = 'components';

    protected $fillable = [];
}
