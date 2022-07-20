<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class ToastsModel extends BaseDocsModel
{
    protected $table = 'toasts';

    protected $parentTable = 'components';

    protected $fillable = [];
}
