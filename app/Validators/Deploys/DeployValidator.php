<?php

namespace App\Validators\Deploys;

use App\Rules\EnviromentDeployRule;
use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class DeployValidator extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_UPDATE => [
            'version' => 'required'
        ],
    ];

    protected function configRule(&$rules)
    {
        $server = $this->data['server'];
        $rules["{$server}_version"] = new EnviromentDeployRule();
    }
}
