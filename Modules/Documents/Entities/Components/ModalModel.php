<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class ModalModel extends BaseDocsModel
{
    protected $table = 'modal';

    protected $parentTable = 'components';

    protected $fillable = [];
}
