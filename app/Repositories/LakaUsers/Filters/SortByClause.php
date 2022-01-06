<?php

namespace App\Repositories\LakaUsers\Filters;

class SortByClause extends BaseClause
{
    protected function apply($query)
    {
        $direction = request('direction', 'asc');

        if (str_is($direction, 'asc')) {
            return $query->sortBy($this->values);
        } else {
            return $query->sortByDesc($this->values);
        }
    }

    protected function validate($value): bool
    {
        return !is_null($value);
    }
}
