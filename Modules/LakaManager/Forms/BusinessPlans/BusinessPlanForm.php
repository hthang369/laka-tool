<?php

namespace Modules\LakaManager\Forms\BusinessPlans;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;

class BusinessPlanForm extends Form
{
    public function buildForm()
    {
        $this
            ->addRequired('name', Field::TEXT)
            ->addRequired('maximum_storage_file', Field::TEXT)
            ->add('description', Field::TEXT);
    }
}
