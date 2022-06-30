<?php

namespace Modules\LakaManager\Repositories\LakaLogs\Filters;

use Modules\Common\Repositories\Filters\BaseClientClause;

class WhereDateClause extends BaseClientClause
{
    protected function apply($query)
    {
        list($dtFrom, $dtTo) = array_values($this->values);
        return $this->filterByDate($query, $dtFrom, $dtTo);
    }

    private function filterByDate($query, $dtFrom, $dtTo)
    {
        return $query->filter(function ($item) use ($dtFrom, $dtTo) {
            $date = str_replace('.', '-', preg_replace('/.*(\d{4}(.\d{2}){2}).*/', '$1', $item['name']));
            return !($dtFrom > $date || $date > $dtTo);
        })->values();
    }

    protected function validate($value): bool {
        return !is_null($value);
    }
}
