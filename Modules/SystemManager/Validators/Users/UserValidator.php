<?php

namespace Modules\SystemManager\Validators\Users;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\SystemManager\Validators;
 */
class UserValidator extends BaseValidator
{
    const RULE_UPDATE_PASSWORD = 'update_pass';

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'roles' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'password' => 'nullable|min:8',
            'email' => 'email|unique:users',
            'roles' => 'required'
        ],
        UserValidator::RULE_UPDATE_PASSWORD => [
            'current_password' => 'required|min:8|password',
            'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ],
    ];
}
