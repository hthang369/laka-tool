<?php

namespace Modules\SiteManager\Forms;

use Illuminate\Support\Facades\File;
use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;

class HostForm extends Form
{
    public function buildForm()
    {
        $this->add('save', Field::BUTTON_SUBMIT, [
            'layout' => 'groups'
        ]);
        $this->add('hosts', Field::TEXTAREA, [
            'attr' => ['id' => 'code'],
            'value' => File::get(data_get($this->getModel(), 'hosts')),
            'label_show' => false,
            'layout' => 'groups'
        ]);
    }
}
