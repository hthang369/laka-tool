<?php

namespace Modules\LakaManager\Forms\LakaUsers;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Modules\Common\Forms\BaseForm;
use Modules\LakaManager\Repositories\Companys\CompanyRepository;

class LakaUserForm extends BaseForm
{
    public function buildForm()
    {
        if (!str_is($this->getAction(), 'detail')) {
            $this
                ->addRequired('name', Field::TEXT)
                ->addRequired('email', Field::EMAIL)
                ->addRequired('password', Field::TEXT)
                ->addRequired('password_confirmation', Field::TEXT)
                ->add('company_id', Field::SELECT, [
                    'choices' => resolve(CompanyRepository::class)->getSelectedList('name', 'id', '-- Select... --'),
                    'selected' => data_get($this->model, 'company_id')
                ])
                ->add('is_user_bot', Field::CHECKBOX, [
                    'label' => __('users.laka.fields.type_of_user'),
                    'checked' => data_get($this->model, 'company_id')
                ])
                ->addRequired('add_contact_option[]', Field::CHECKBOX_GROUP, [
                    'label' => __('users.laka.add_contact_option'),
                    'choices' => ['add_all_contacts' => __('users.laka.add_all_contacts'), 'add_to_all_rooms' => __('users.laka.add_to_all_rooms')]
                ]);
        } else {
            $this
                ->add('name', Field::STATIC)
                ->add('email', Field::STATIC)
                ->add('company', Field::STATIC)
                ->add('user_type', Field::STATIC)
                ->add('is_bot', Field::STATIC)
                ->add('company_id', Field::SELECT, [
                    'choices' => resolve(CompanyRepository::class)->getSelectedList('name', 'id', '-- Select... --'),
                    'selected' => data_get($this->model, 'company_id')
                ]);
        }

    }
}
