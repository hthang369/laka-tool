<?php

namespace App\Repositories\LakaUsers\Filters;

abstract class BaseClause
{
    protected $query;
    protected $column;
    protected $values;

    public function __construct($values, $column)
    {
        $this->values = $values;
        $this->column = $column;
    }

    public function handle($query, $nextFilter)
    {
        $this->query = $query;

        if ($this->validate($this->values) === false) {
            return $this->query;
        }

        $results = $this->apply($this->query);

        return $nextFilter($results);
    }

    abstract protected function apply($query);

    abstract protected function validate($value): bool;
}
