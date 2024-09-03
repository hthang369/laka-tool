<?php
namespace Modules\Api\Repositories\Formatters;

use Illuminate\Support\Collection;

class ServerTableFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        return $content;
    }
}
