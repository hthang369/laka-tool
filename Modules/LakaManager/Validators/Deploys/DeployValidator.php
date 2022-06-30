<?php

namespace Modules\LakaManager\Validators\Deploys;

use Laka\Core\Validators\BaseValidator;
use Modules\LakaManager\Rules\EnviromentDeployRule;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\LakaManager\Validators;
 */
class DeployValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        ],
        ValidatorInterface::RULE_UPDATE => [
            'deploy_version' => 'required',
            'redmine_ticket'  => 'required',
            'environment' => 'required',
            'server' => 'required'
        ],
    ];

    protected function configRule(&$rule)
    {
        $rule['deploy_version'] = new EnviromentDeployRule();
    }
}
