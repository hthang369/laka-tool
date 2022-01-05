<?php
namespace App\Repositories\LakaUsers;

use Illuminate\Pipeline\Pipeline;

trait LakaUserCriteria
{
    public function filterByRequest($results)
    {
        $filters = $this->getResolveFilters();

        return app(Pipeline::class)
            ->send(collect($results))
            ->through($filters)
            ->then(function ($data) {
                return $this->postFilterByRequest($data);
            });

    }

    protected function postFilterByRequest($data)
    {
        return $this->defaultOrderBy($data);
    }

    protected function defaultOrderBy($data)
    {
        return $data;
    }
}
