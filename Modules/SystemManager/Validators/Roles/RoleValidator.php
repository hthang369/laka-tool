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
            'level' => 'required|min:2',
            'name'  => 'required|min:2',
            'role_rank'  => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'level' => 'required|min:2',
            'name'  => 'required|min:2',
            'role_rank'  => 'required|numeric'
        ],
    ];
}
