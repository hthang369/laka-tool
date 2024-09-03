<?php

namespace Modules\Api\Entities\Windmill;

class RuleConditionDefinition extends WindmillModel
{
    protected $table = 'rule_condition_definition';

    protected $fillable = [
        'platform',
        'layer',
        'channel',
        'metric',
        'value_type',
        'status',
    ];
}
