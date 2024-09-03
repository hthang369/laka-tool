<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRuleConditionReallocation extends WindmillModel
{
    protected $table = 'template_rule_condition_reallocation';

    protected $fillable = [
        'template_rule_action_id',
        'rule_condition_definition_id',
        'rule_condition_drop_list_id',
        'operator',
        'operate_value',
        'condition_expression',
        'extend_info',
        'sort_no',
        'status'
    ];
}
