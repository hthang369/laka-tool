<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class ImageModel extends BaseDocsModel
{
    protected $table = 'image';

    protected $parentTable = 'components';

    protected $fillable = [];
}
