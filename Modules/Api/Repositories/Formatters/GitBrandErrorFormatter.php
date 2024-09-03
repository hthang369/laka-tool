<?php
namespace Modules\Api\Repositories\Formatters;

class GitBrandErrorFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        $error = array_map(function($item) {
            list($key, $value) = explode(':', $item);
            return [$key => $value];
        }, array_filter(explode(PHP_EOL ,$content)));
        return array_first(array_filter(data_get($error, '*.error')));
    }
}
