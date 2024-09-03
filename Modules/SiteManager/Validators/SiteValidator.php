<?php

namespace Modules\SiteManager\Validators;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\SiteManager\Validators;
 */
class SiteValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'document_root'  => 'required',
            'php_instance_id'  => 'required|numeric',
            'httpd_instance_id'  => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required'
        ],
    ];
}
