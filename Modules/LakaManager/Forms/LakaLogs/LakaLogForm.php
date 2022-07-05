<?php

namespace Modules\LakaManager\Forms\LakaLogs;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;

class LakaLogForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('log_level', Field::STATIC)
            ->add('ip', Field::STATIC)
            ->add('date_log', Field::STATIC)
            ->add('message', Field::STATIC);
    }
}
