<?php

namespace Modules\LakaManager\Validators\LakaUsers;

use Laka\Core\Validators\BaseValidator;
use Modules\LakaManager\Rules\VerifyCode;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\LakaManager\Validators;
 */
class LakaUserValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'company_id' => 'required|numeric',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'company_id' => 'required|numeric'
        ],
        'RULE_CONFIRM' => [
            'code' => ['required', 'numeric', 'digits:4']
        ]
    ];

    protected function configRule(&$rule)
    {
        array_push($rule['code'], new VerifyCode());
    }
}
