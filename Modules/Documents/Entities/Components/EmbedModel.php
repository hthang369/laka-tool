<?php

namespace Modules\Documents\Entities\Components;

use Modules\Documents\Entities\BaseDocsModel;

class EmbedModel extends BaseDocsModel
{
    protected $table = 'embed';

    protected $parentTable = 'components';

    protected $fillable = [];
}
