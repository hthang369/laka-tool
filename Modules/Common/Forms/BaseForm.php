<?php

namespace Modules\Common\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class BaseForm extends Form
{
    protected function fieldType($type)
    {
        $reflector = new \ReflectionClass(Field::class);
        $action = $this->getAction();
        return str_is($action, 'detail') ? Field::STATIC : $reflector->getConstant($type);
    }

    protected function getAction()
    {
        return data_get($this->formOptions, 'action');
    }
}
