<?php

namespace App\Repositories\LakaUsers\Filters;

class SortByClause extends BaseClause
{
    protected function apply($query)
    {
        $direction = request('direction', 'asc');
        if (str_is($direction, 'asc')) {
            return $query->sortBy($this->column);
        } else {
            return $query->sortByDesc($this->column);
        }
    }

    protected function validate($value): bool
    {
        return !is_null($value);
    }
}
