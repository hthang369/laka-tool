<?php
namespace Modules\Api\Repositories\Formatters;

class ServiceFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        if (is_string($content)) {
            return json_convert($content);
        }
        return $content;
    }
}
