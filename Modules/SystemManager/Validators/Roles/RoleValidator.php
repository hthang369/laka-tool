<?php

namespace Modules\SystemManager\Validators\Roles;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\SystemManager\Validators;
 */
class RoleValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'level' => 'required',
            'name'  => 'required',
            'role_rank'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'level' => 'required',
            'name'  => 'required',
            'role_rank'  => 'required'
        ],
    ];
}
