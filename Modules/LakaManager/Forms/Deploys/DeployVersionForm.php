<?php

namespace Modules\LakaManager\Forms\Deploys;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Laka\Core\Facades\Common;
use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;

class DeployVersionForm extends Form
{
    public function buildForm()
    {
        $environment = data_get($this->model, 'environment');
        $list_server = array_keys(config("laka.deploy.list_environment.{$environment}"));
        $defaultServer = head($list_server);
        $sectionCode = Common::getSectionCode();

        $this
            ->add('server', Field::SELECT, [
                'choices' => array_combine($list_server, array_map('ucfirst', $list_server))
            ])
            ->add('version', Field::STATIC, [
                'value' => Blade::render('<x-badge variant="success" text="{{$name}}"></x-badge>', ['name' => data_get($this->model, "serverArray.{$defaultServer}.version")])
            ])
            ->addRequired('redmine_ticket', Field::TEXT)
            ->addRequired('deploy_version', Field::TEXT);

        if (user_can("add_{$sectionCode}")) {
            $this->add('deploy', Field::BUTTON_BUTTON, [
                'label' => __('common.deploy'),
                'attr' => ['class' => ['btn-deploy'], 'data-loading' => translate('table.loading_text')],
                'variant' => 'primary',
                'size' => 'sm',
                'icon' => 'fa-cogs'
            ]);
        }
    }
}
