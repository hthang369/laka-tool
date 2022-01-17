<?php

namespace App\Repositories\Core;

use Laka\Core\Repositories\BaseRepository;
use Laka\Core\Traits\Grids\PresenterDataGrid;

abstract class CoreRepository extends BaseRepository
{
    use PresenterDataGrid;

    public function formGenerate()
    {
        return null;
    }
}
