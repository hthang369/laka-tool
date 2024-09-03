<?php

namespace Modules\SiteManager\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Modules\SiteManager\Entities\InstanceModel;

class SiteForm extends Form
{
    public function buildForm()
    {
        $this->add('name', Field::TEXT);
        $this->add('alias', Field::TEXT);
        $this->add('document_root', Field::TEXT);
        $this->add('php_instance_id', Field::SELECT, [
            'choices' => InstanceModel::whereHas('vendor', function($query) {
                return $query->where('type', 'php');
            })->pluck('name', 'id'),
            'empty_value' => 'Select Instance'
        ]);
        $this->add('httpd_instance_id', Field::SELECT, [
            'choices' => InstanceModel::whereHas('vendor', function($query) {
                return $query->where('type', 'httpd');
            })->pluck('name', 'id'),
            'empty_value' => 'Select Instance'
        ]);
        $this->add('path', Field::HIDDEN, [
            'value' => '/opt/homebrew/etc'
        ]);
    }
}
