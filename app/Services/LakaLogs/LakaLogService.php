<?php

namespace App\Services\LakaLogs;

class LakaLogService
{
    public function filesFilterByDate($files, $dtFrom, $dtTo)
    {
        return $files->filter(function($item) use($dtFrom, $dtTo) {
            $date = str_replace('.', '-', preg_replace('/.*(\d{4}(.\d{2}){2}).*/', '$1', $item['name']));
            return !($dtFrom > $date || $date > $dtTo);
        })->values();
    }

    public function filesSortByColumn($files, $column, $direction)
    {
        $method = str_is($direction, 'asc') ? 'sortBy' : 'sortByDesc';
        return $files->{$method}($column);
    }
}
