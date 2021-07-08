<?php

namespace App\Core\Observers;

use App\Core\Entities\BaseModel;

class BaseModelObserver
{
    public function creating(BaseModel $baseModel)
    {
        $baseModel->setCreatedUpdatedUsers();
    }

    /**
     * Handle the base model "saving" event.
     *
     * @param  \App\BaseModel  $baseModel
     * @return void
     */
    public function saving(BaseModel $baseModel)
    {
        $baseModel->setCreatedUpdatedUsers();
    }

    /**
     * Handle the base model "updated" event.
     *
     * @param  \App\BaseModel  $baseModel
     * @return void
     */
    public function updating(BaseModel $baseModel)
    {
        $baseModel->setCreatedUpdatedUsers();
    }

    /**
     * Handle the base model "created" event.
     *
     * @param  \App\BaseModel  $baseModel
     * @return void
     */
    public function created(BaseModel $baseModel)
    {
    }

    /**
     * Handle the base model "deleted" event.
     *
     * @param  \App\BaseModel  $baseModel
     * @return void
     */
    public function deleted(BaseModel $baseModel)
    {
    }
}
