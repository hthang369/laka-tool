<?php

namespace App\Core\Validators;

use App\Core\Support\Mysql;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class BaseValidator
 * @package App\Core\Validators
 */
class BaseValidator extends LaravelValidator
{
    protected $tableName;
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];

    public function getRules($action = null)
    {
        $rule = parent::getRules($action);

        $this->addMaxLengthRule($rule);

        return $rule;
    }

    private function addMaxLengthRule(&$rules)
    {
        if (count($rules) == 0 || blank($this->tableName)) return;
        $structTable = collect(Mysql::getStructTableColumns($this->tableName))->groupBy('COLUMN_NAME');
        array_walk($rules, function (&$ruleAction, $field) use($structTable) {
            if ($structTable->has($field)) {
                if (!is_array($ruleAction)) {
                    $ruleAction = explode("|", $ruleAction);
                }

                if (in_array('string', $ruleAction) && in_array('max:auto', $ruleAction)) {
                    $dataLength = data_get($structTable->get($field)->first(), 'DATA_LENGTH');
                    $idx = array_search('max', $ruleAction);
                    $ruleAction[$idx] = "max:$dataLength";
                }
            }
        });
    }
}
