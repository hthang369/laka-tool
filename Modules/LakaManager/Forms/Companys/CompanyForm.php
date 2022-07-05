<?php

namespace Modules\LakaManager\Forms\Companys;

use Laka\Core\Forms\Field;
use Modules\Common\Forms\BaseForm;
use Modules\LakaManager\Repositories\BusinessPlans\BusinessPlanRepository;

class CompanyForm extends BaseForm
{
    public function buildForm()
    {
        $repository = resolve(BusinessPlanRepository::class);
        $value = '';
        if ($this->model->business_plan_id) {
            $value = $repository->find($this->model->business_plan_id, ['name'])->name;
        }
        $this
            ->addRequired('name', $this->fieldType('TEXT'))
            ->addRequired('email', $this->fieldType('EMAIL'))
            ->add('phone', $this->fieldType('TEXT'))
            ->add('address', $this->fieldType('TEXT'))
            ->add('business_plan_id', $this->fieldType('SELECT'), [
                'choices' => $repository->getSelectedList('name', 'id', '-- Select... --'),
                'selected' => $this->model->business_plan_id,
                'value' => $value
            ]);
    }
}
