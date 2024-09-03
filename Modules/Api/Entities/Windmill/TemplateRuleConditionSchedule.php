<?php

namespace Modules\Api\Entities\Windmill;

class TemplateRuleConditionSchedule extends WindmillModel
{
    protected $table = 'template_rule_condition_schedule_time';

    protected $fillable = [
        'template_rule_condition_id',
        'day_of_week',
        'schedule_time_value',
        'cron',
        'status'
    ];
}
