<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRuleAction extends WindmillModel
{
    protected $table = 'template_rule_action';

    protected $fillable = [
        'template_rule_id',
        'rule_action_definition_id',
        'operate_value',
        'value_limit',
        'extend_info',
        'sort_no',
        'status'
    ];
}
