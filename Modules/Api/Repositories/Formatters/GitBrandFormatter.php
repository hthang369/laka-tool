<?php
namespace Modules\Api\Repositories\Formatters;

class GitBrandFormatter extends BaseFormatter
{
    protected function apply($content)
    {
        return collect(array_filter(explode(PHP_EOL, $content)))->map(function($line) {
            return [
                'name' => trim(trim($line, '*')),
                'active' => starts_with($line, '*'),
                'show' => true
            ];
        });
    }
}
