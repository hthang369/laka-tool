<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class LinkModel extends BaseDocsModel
{
    protected $table = 'link';

    protected $parentTable = 'components';

    protected $fillable = [];
}
