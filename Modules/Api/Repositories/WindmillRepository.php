<?php

namespace Modules\Api\Repositories;

use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Support\Facades\DB;
use Laka\Core\Repositories\BaseRepository;
use Modules\Api\Entities\Windmill\RuleActionDefinition;
use Modules\Api\Entities\Windmill\RuleConditionDefinition;
use Modules\Api\Entities\Windmill\Template;
use Modules\Api\Entities\Windmill\TemplateRule;
use Modules\Api\Entities\Windmill\TemplateRuleAction;
use Modules\Api\Entities\Windmill\TemplateRuleActionReallocation;
use Modules\Api\Entities\Windmill\TemplateRuleCondition;
use Modules\Api\Entities\Windmill\TemplateRuleConditionReallocation;
use Modules\Api\Entities\Windmill\TemplateRuleConditionSchedule;
use Modules\Api\Entities\Windmill\TemplateSchedule;

class WindmillRepository extends BaseRepository
{
    use ManagesFrequencies;

    protected $modelClass = Template::class;

    public $expression = '* * ? * *';

    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes) {
            return $this->createTemplate($attributes);
        });
    }

    protected function createTemplate($templates)
    {
        $template = array_except($templates, ['schedule', 'rules']);
        $schedule = data_get($templates, 'schedule');
        $rules = data_get($templates, 'rules');
        $template['status'] = 3;
        $templateInfo = Template::create($template);
        // $this->createTemplateRule($rules, $templateInfo, $schedule['type']);
        $this->createTemplateSchedule($schedule, $templateInfo->id);
        return $templateInfo;
    }

    protected function createTemplateRule($rules, $template, $frequency)
    {
        $tmp_id = $template->id;
        $lstUniqCond = $this->getMetricByType($rules, 'conditions', 'metric');
        $lstUniqAct = $this->getMetricByType($rules, 'actions', 'action');
        $lstUniqSubAct = $this->getMetricByType($rules, 'actions', 'sub_action');
        $lstUniqCondReallocate = $this->getMetricByReallocate($rules);
        $ruleCondDefine = RuleConditionDefinition::whereIn('metric', $lstUniqCond)->where([
            'platform' => $template->platform,
            'channel' => $template->channel,
            'layer' => $template->target,
            'status' => 1
        ])->get(['id', 'metric', 'value_type'])->groupBy('metric')->map(fn($item) => $item->first());

        $ruleCondDefineReallocate = RuleConditionDefinition::whereIn('metric', $lstUniqCondReallocate)->where([
            'platform' => $template->platform,
            'channel' => $template->channel,
            'layer' => $template->target,
            'status' => 1
        ])->get(['id', 'metric', 'value_type'])->groupBy('metric')->map(fn($item) => $item->first());

        $ruleActDefine = RuleActionDefinition::whereIn('metric', $lstUniqAct)->where([
            'platform' => $template->platform,
            'layer' => $template->target,
            'status' => 1
        ])->whereIn('operation_key', $lstUniqSubAct)
        ->get(['id', 'metric', 'operation'])->groupBy('metric')->map(fn($item) => $item->first());

        foreach($rules as $idx => $rule) {
            $dataRule = array_except($rule, ['conditions', 'actions']);
            $dataRule['template_id'] = $tmp_id;
            $dataRule['sort_no'] = $idx + 1;
            $dataRule['status'] = 3;
            $conditions = data_get($rule, 'conditions');
            $actions = data_get($rule, 'actions');
            $ruleInfo = TemplateRule::create($dataRule);
            $this->createTemplateRuleCondition($conditions, $ruleInfo->id, $ruleCondDefine, $frequency);
            $this->createTemplateRuleAction($actions, $ruleInfo->id, $ruleActDefine, $ruleCondDefineReallocate);
        }
    }

    protected function createTemplateSchedule($schedule, $tmp_id)
    {
        $schedule['template_id'] = $tmp_id;
        $schedule['status'] = 3;
        $schedule['cron'] = $this->generateCronFromTime($schedule['type'], $schedule['cron_display']);
        dd($schedule);
        TemplateSchedule::create($schedule);
    }

    protected function createTemplateRuleCondition($conditions, $rule_id, $ruleCondDefine, $frequency)
    {
        foreach($conditions as $idx => $cond) {
            $metric = $cond['metric'];
            $cond['template_rule_id'] = $rule_id;
            $cond['sort_no'] = $idx + 1;
            $cond['status'] = 3;
            $cond['input_condition_type'] = 1;
            $cond['rule_condition_definition_id'] = $ruleCondDefine[$metric]->id;
            $cond['type'] = $metric == 'status' ? 'text' : $ruleCondDefine[$metric]->value_type;
            $cond['operate_value'] = $metric == 'store_local_time' ? '' : $cond['input_value'];
            $cond['condition_expression'] = $this->generateCondExpression($metric, $cond['operator'], $cond['operate_value']);
            $ruleCondInfo = TemplateRuleCondition::create($cond);
            if ($metric == 'store_local_time') {
                $this->createTemplateRuleConditionScheduleTime(array_wrap($cond['input_value']), $ruleCondInfo->id, $frequency);
            }
        }
    }

    protected function createTemplateRuleConditionScheduleTime($schedules, $rule_cond_id, $frequency)
    {
        foreach($schedules as $schedule) {
            list($dayOfWeek, $time) = explode('_', $schedule, 2);
            if ($frequency != 'weekly') {
                $dayOfWeek = -1;
                $time = $schedule;
            }
            $condSchedule = [
                'template_rule_condition_id' => $rule_cond_id,
                'day_of_week' => $dayOfWeek,
                'status' => 3,
                'schedule_time_value' => $time,
                'cron' => $this->generateCronFromTime('daily', $time)
            ];
            TemplateRuleConditionSchedule::create($condSchedule);
        }
    }

    protected function createTemplateRuleAction($actions, $rule_id, $ruleActDefine, $ruleCondDefineReallocate)
    {
        foreach($actions as $idx => $act) {
            $ruleDefineId = $ruleActDefine[$act['action']]->id;
            $act['template_rule_id'] = $rule_id;
            $act['sort_no'] = $idx + 1;
            $act['status'] = 3;
            $act['rule_action_definition_id'] = $ruleDefineId;
            $act['operate_value'] = $ruleActDefine[$act['action']]->operation;
            $act['value_limit'] = '';
            $ruleActInfo = TemplateRuleAction::create($act);
            if (data_get($act, 'reallocate')) {
                $this->createTemplateRuleActionReallocation(data_get($act, 'reallocate'), $ruleActInfo->id, $ruleDefineId, $ruleCondDefineReallocate);
            }
        }
    }

    protected function createTemplateRuleActionReallocation($reallocation, $rule_act_id, $rule_act_define_id, $ruleCondDefineReallocate)
    {
        if ($reallocation['limit'] > 0) {
            foreach(array_wrap($reallocation['number']) as $idx => $num) {
                $reallocate = [
                    'template_rule_action_id' => $rule_act_id,
                    'metric' => $reallocation['metric'],
                    'priority' => $reallocation['priority'],
                    'status' => 3,
                    'number' => $num,
                    'order_by' => $idx + 1,
                    'rule_action_definition_id' => $rule_act_define_id
                ];
                TemplateRuleActionReallocation::create($reallocate);
            }
        }
        $conditions = data_get($reallocation, 'conditions');
        if ($conditions) {
            foreach($conditions as $idx => $cond) {
                $cond['template_rule_action_id'] = $rule_act_id;
                $cond['status'] = 3;
                $cond['sort_no'] = $idx + 1;
                $cond['rule_condition_definition_id'] = $ruleCondDefineReallocate[$cond['metric']]->id;
                $cond['operate_value'] = $cond['input_value'];
                $cond['condition_expression'] = $this->generateCondExpression($cond['metric'], $cond['operator'], $cond['operate_value']);
                TemplateRuleConditionReallocation::create($cond);
            }
        }
    }

    private function generateCronFromTime($frequency, $time)
    {
        switch($frequency) {
            case 'daily':
                $this->dailyAt($time);
            break;
            case 'hourly':
                $this->hourlyAt($time);
            break;
            case 'weekly':
                list($dayOfWeek, $value) = explode('_', $time);
                $this->weeklyOn($dayOfWeek, $value);
            break;
            default:
                $this->spliceIntoPosition(1, "0/$time");
            break;
        }

        return "0 {$this->expression} *";
    }

    private function generateCondExpression($metric, $operator, $value)
    {
        switch($metric) {
            case 'store_local_time':
                return '';
            break;
            default:
                $newOperator = $operator == '=' ? '==' : $operator;
                $newValue = is_numeric($value) ? $value : "'$value'";
                if ($operator == 'between') {
                    list($start, $end) = $value;
                    return "$start <= $metric && $metric <= $end";
                }
                return "$metric $newOperator $newValue";
            break;
        }
    }

    private function getMetricByType($rules, $type, $metric)
    {
        $lstCondition = array_collapse(array_pluck($rules, $type));
        return array_unique(array_pluck($lstCondition, $metric));
    }

    private function getMetricByReallocate($rules)
    {
        $lstUniqReallocate = $this->getMetricByType($rules, 'actions', 'reallocate');
        return $this->getMetricByType($lstUniqReallocate, 'conditions', 'metric');
    }
}
