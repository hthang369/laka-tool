<?php

namespace Modules\SystemManager\Entities\Roles;

use Laka\Core\Entities\BaseModel;

class RoleModel extends BaseModel
{
    protected $table = 'roles';

    protected $fillable = ['level', 'name', 'role_rank', 'description'];

    protected $fillableColumns = [
        'id',
        'level',
        'name',
        'role_rank',
        'description'
    ];

    public function listenSaving()
    {
        if (blank($this->description)) {
            $this->description = $this->name;
        }
        $this->guard_name = 'web';
    }
}
