<?php

namespace App\Validators\Users;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface; 


class UserValidator extends BaseValidator
{
    const RULE_UPDATE_PASSWORD = 'update_pass';

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ],  
        UserValidator::RULE_UPDATE_PASSWORD => [
            'current_password' => 'required|min:8',
            'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ],
    ];
}
