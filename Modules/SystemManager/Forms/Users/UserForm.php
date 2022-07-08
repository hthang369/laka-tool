<?php

namespace Modules\SystemManager\Forms\Users;

use Illuminate\Support\Facades\Blade;
use Laka\Core\Forms\Field;
use Modules\Common\Forms\BaseForm;
use Modules\SystemManager\Entities\Roles\RoleModel;

class UserForm extends BaseForm
{
    public function buildForm()
    {
        $emailType = (!is_null($this->model->id)) ? Field::STATIC : Field::EMAIL;

        $this
            ->addRequired('email', $emailType)
            ->add('name', $this->fieldType('TEXT'));
        if (!str_is($this->getAction(), 'detail')) {
            $this->add('password', $this->fieldType('PASSWORD'));
        }
        $this->add('phone', $this->fieldType('TEXT'))
            ->add('address', $this->fieldType('TEXT'));

        if (!str_is($this->getAction(), 'detail')) {
            $this->add('roles[]', Field::CHECKBOX_GROUP, [
                'label' => 'Roles',
                'value' => function($form, $value) {
                    return $value->pluck('level')->toArray();
                },
                'choices' => RoleModel::pluck('name', 'level')->toArray(),
                'control' => [
                    'class' => ['custom-control-inline']
                ]
            ]);
        } else {
            $this->add('roles[]', Field::STATIC, [
                'label' => 'Roles',
                'value' => function($form, $value) {
                    return $this->generateBadgeRoles($value);
                }
            ]);
        }
    }

    private function generateBadgeRoles($roles)
    {
        return $roles->pluck('name')->map(function($item) {
            return Blade::render('<x-badge variant="primary" text="{{$name}}"></x-badge>', ['name' => $item]);
        })->join('');
    }
}
