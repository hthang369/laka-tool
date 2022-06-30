<?php

namespace Modules\LakaManager\Validators\BusinessPlans;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\LakaManager\Validators;
 */
class BusinessPlanValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:150',
            'maximum_storage_file' => 'required|max:10000000|numeric',
            'description' => 'max:500'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:190',
            'maximum_storage_file' => 'nullable|max:10000000|numeric',
            'description' => 'nullable|max:500'
        ],
    ];
}
