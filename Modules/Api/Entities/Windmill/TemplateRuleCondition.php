<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRuleCondition extends WindmillModel
{
    protected $table = 'template_rule_condition';

    protected $fillable = [
        'template_rule_id',
        'rule_condition_definition_id',
        'rule_condition_value_drop_list_id',
        'operator',
        'operate_value',
        'condition_expression',
        'extend_info',
        'sort_no',
        'type',
        'input_condition_type',
        'input_condition_value',
        'status'
    ];
}
