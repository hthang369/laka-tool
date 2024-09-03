<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRuleActionReallocation extends WindmillModel
{
    protected $table = 'template_rule_action_reallocation';

    protected $fillable = [
        'template_rule_action_id',
        'rule_action_definition_id',
        'metric',
        'order_by',
        'priority',
        'number',
        'status'
    ];
}
