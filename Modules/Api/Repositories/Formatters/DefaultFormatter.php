<?php
namespace Modules\Api\Repositories\Formatters;

class DefaultFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        dd($content);
        return json_convert($content);
    }
}
