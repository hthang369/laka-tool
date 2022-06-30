<?php

namespace Modules\LakaManager\Forms\LakaUsers;

use Laka\Core\Forms\Field;
use Modules\Common\Forms\BaseForm;

class LakaUserDisableForm extends BaseForm
{
    public function buildForm()
    {
        $this
            ->add('name', Field::STATIC)
            ->add('email', Field::STATIC)
            ->addRequired('code', Field::TEXT);
    }
}
