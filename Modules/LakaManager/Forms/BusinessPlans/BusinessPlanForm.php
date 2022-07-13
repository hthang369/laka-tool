<?php

namespace Modules\LakaManager\Forms\BusinessPlans;

use Modules\Common\Forms\BaseForm;

class BusinessPlanForm extends BaseForm
{
    public function buildForm()
    {
        $this
            ->addRequired('name', $this->fieldType('TEXT'))
            ->addRequired('maximum_storage_file', $this->fieldType('TEXT'))
            ->add('description', $this->fieldType('TEXT'));
    }
}
