<?php

namespace App\Repositories\LakaUsers\Filters;

class WhereLikeClause extends BaseClause
{
    protected function apply($query)
    {
        return $query->filter(function($value, $key) {
            return str_contains(vn_str_filter(strtolower(data_get($value, $this->column))), vn_str_filter(strtolower($this->values)));
        });
    }

    protected function validate($value): bool
    {
        return !is_null($value);
    }
}
