<?php

namespace Modules\Api\Entities\Windmill;

class RuleActionDefinition extends WindmillModel
{
    protected $table = 'rule_action_definition';

    protected $fillable = [
        'platform',
        'layer',
        'channel',
        'metric',
        'value_type',
        'status',
    ];
}
