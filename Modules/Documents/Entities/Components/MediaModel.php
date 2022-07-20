<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class MediaModel extends BaseDocsModel
{
    protected $table = 'media';

    protected $parentTable = 'components';

    protected $fillable = [];
}
