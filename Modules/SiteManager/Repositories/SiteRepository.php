<?php

namespace Modules\SiteManager\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\SiteManager\Entities\SiteModel;
use Modules\SiteManager\Grids\SiteGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\SiteManager\Entities\InstanceModel;
use Modules\SiteManager\Forms\SiteForm;
use Nwidart\Modules\Generators\FileGenerator;
use Nwidart\Modules\Support\Stub;

class SiteRepository extends CoreRepository
{
    protected $presenterClass = SiteGrid::class;

    protected $modelClass = SiteModel::class;

    protected $formClass = SiteForm::class;

    public function create(array $attributes)
    {
        DB::transaction(function () use($attributes) {
            $httpd_instance_id = data_get($attributes, 'httpd_instance_id');
            $attrName = data_get($attributes, 'name');
            list($name,) = explode('.', $attrName);
            $httpd_instance = InstanceModel::find($httpd_instance_id);
            $path = data_get($attributes, 'path');
            if ($httpd_instance->name === 'nginx') {
                $filePath = "{$path}/{$httpd_instance->name}/servers/{$name}.conf";
            }
            data_set($attributes, 'path', $filePath);
            parent::create($attributes);
            // Stub::setBasePath(module_path('sitemanager', 'Repositories/Stub'));
            // $contents = (new Stub('vhost.stub', [
            //     'PORT' => 80,
            //     'DOMAIN' => $name,
            //     'DOCUMENT_ROOT' => data_get($attributes, 'document_root')
            // ]))->render();
            // (new FileGenerator($filePath, $contents))->generate();
        });
    }
}
