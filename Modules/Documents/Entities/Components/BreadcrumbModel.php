<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class BreadcrumbModel extends BaseDocsModel
{
    protected $table = 'breadcrumb';

    protected $parentTable = 'components';

    protected $fillable = [];
}
