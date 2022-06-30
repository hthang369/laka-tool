<?php

namespace Modules\LakaManager\Forms\Companys;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Modules\LakaManager\Repositories\BusinessPlans\BusinessPlanRepository;

class CompanyForm extends Form
{
    public function buildForm()
    {
        $this
            ->addRequired('name', Field::TEXT)
            ->addRequired('email', Field::EMAIL)
            ->add('phone', Field::TEXT)
            ->add('address', Field::TEXT)
            ->add('business_plan_id', Field::SELECT, [
                'choices' => resolve(BusinessPlanRepository::class)->getSelectedList('name', 'id', '-- Select... --')
            ]);
    }
}
