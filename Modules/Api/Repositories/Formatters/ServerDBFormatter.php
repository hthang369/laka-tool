<?php
namespace Modules\Api\Repositories\Formatters;

use Illuminate\Support\Collection;

class ServerDBFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        return array_map(function($item) {
            return data_get($item, 'Database');
        }, $content);
    }
}
