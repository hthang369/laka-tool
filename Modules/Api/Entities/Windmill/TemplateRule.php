<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRule extends WindmillModel
{
    protected $table = 'template_rule';

    protected $fillable = [
        'template_id',
        'name',
        'sort_no',
        'status'
    ];
}
