<?php

namespace Modules\Api\Validators;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Api\Validators;
 */
class ServersValidator extends BaseValidator
{
    const RULE_LOAD = 'loaded';
    const RULE_SERVICE = 'service';
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        self::RULE_LOAD => [
            'type' => 'required',
            'server_type'  => 'required',
            'server_name'  => 'required'
        ],
        self::RULE_SERVICE => [
            'name' => 'required',
            'action' => 'required'
        ],
        ValidatorInterface::RULE_CREATE => [
            'service' => 'required',
            'name' => 'required',
            'server_name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required'
        ],
    ];
}
