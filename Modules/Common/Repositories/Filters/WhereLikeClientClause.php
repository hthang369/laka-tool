<?php

namespace Modules\Common\Repositories\Filters;

class WhereLikeClientClause extends BaseClientClause
{
    protected function apply($query)
    {
        return $query->filter(function($value, $key) {
            return str_contains(vn_str_filter(strtolower(data_get($value, $this->column))), vn_str_filter(strtolower($this->values)));
        })->values();
    }

    protected function validate($value): bool
    {
        return !is_null($value);
    }
}
