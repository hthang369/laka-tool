<?php

namespace Modules\LakaManager\Validators\Companys;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\LakaManager\Validators;
 */
class CompanyValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email' => "required|email|max:190|unique:company,email",
            'name' => "required|max:190|unique:company,name",
            'business_plan_id' => 'required|integer',
            'phone' => 'digits_between:1,10|numeric',
            'address' => 'max:190'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'email' => "required|email|max:190|unique:company,email",
            'name' => "required|max:190|unique:company,name",
            'business_plan_id' => 'required|integer',
            'phone' => 'digits_between:1,10|numeric',
            'address' => 'max:190'
        ],
    ];
}
