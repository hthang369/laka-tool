<?php

namespace Modules\SiteManager\Entities;

use Laka\Core\Entities\BaseModel;

class SiteModel extends BaseModel
{
    protected $connection = 'sqlite';

    protected $table = 'sites';

    protected $fillable = [
        'name',
        'alias',
        'ssl_key',
        'ssl_crt',
        'document_root',
        'path',
        'php_instance_id',
        'httpd_instance_id',
        'vendor_id',
        'vendor_ver'
    ];
}
