<?php

namespace App\Repositories\Core;

use Laka\Core\Repositories\BaseRepository;
use App\Traits\PresenterDataGrid;

abstract class CoreRepository extends BaseRepository
{
    use PresenterDataGrid;

    public function formGenerate()
    {
        return null;
    }

    public function allDataGrid()
    {
        if ($this->presenterGrid) {
            $data = $this->paginate();
            return [$this->presenterGrid, $data];
        }
        return [];
    }
}
