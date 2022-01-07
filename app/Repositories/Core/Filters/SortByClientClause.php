<?php

namespace App\Repositories\Core\Filters;

class SortByClientClause extends BaseClientClause
{
    protected function apply($query)
    {
        $direction = request('direction', 'asc');

        $method = str_is($direction, 'asc') ? 'sortBy' : 'sortByDesc';

        return $query->{$method}($this->values)->values();
    }

    protected function validate($value): bool
    {
        return !is_null($value);
    }
}
