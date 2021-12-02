<?php

namespace App\Validators\LakaUsers;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class LakaUserValidator extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'company_id' => 'required',

        ],
        ValidatorInterface::RULE_UPDATE => [
            'company_id' => 'required',
            'add_contact_option' => 'required'
        ],
    ];

}
