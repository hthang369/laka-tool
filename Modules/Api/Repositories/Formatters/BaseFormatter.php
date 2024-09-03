<?php
namespace Modules\Api\Repositories\Formatters;

use Closure;

abstract class BaseFormatter
{
    public function handle($content, Closure $next)
    {
        $newContent = $this->apply($content);

        return $next($newContent);
    }

    abstract protected function apply($content);
}
