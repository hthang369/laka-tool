<?php

namespace Modules\Documents\Entities;

use Laka\Core\Entities\BaseModel;

class BaseDocsModel extends BaseModel
{
    protected $table = '';

    protected $parentTable = '';

    protected $fillable = [];

    public function getAllData()
    {
        $results = collect(config('documents.menus'))->filter(function ($item) {
            return str_is(strtolower($item['name']), $this->parentTable);
        })->first();

        return collect($results['children'])->filter(function ($subItem) {
            return str_is(strtolower(data_get($subItem, 'name')), $this->table);
        })->first();
    }
}
