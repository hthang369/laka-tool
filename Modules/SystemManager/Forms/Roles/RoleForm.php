<?php

namespace Modules\SystemManager\Forms\Roles;

use Laka\Core\Forms\Field;
use Modules\Common\Forms\BaseForm;

class RoleForm extends BaseForm
{
    public function buildForm()
    {
        $this
            ->addRequired('level', $this->fieldType('TEXT'))
            ->addRequired('name', $this->fieldType('TEXT'))
            ->addRequired('role_rank', $this->fieldType('TEXT'))
            ->add('description', $this->fieldType('TEXTAREA'), [
                'attr' => ['rows' => 5]
            ]);
    }
}
