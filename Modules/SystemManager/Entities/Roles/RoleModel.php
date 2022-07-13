<?php

namespace Modules\SystemManager\Entities\Roles;

use Laka\Core\Permissions\Role;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Guard;

class RoleModel extends Role
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

    public static function findByLevel(string $name, $guardName = null)
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $role = static::where('level', $name)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw RoleDoesNotExist::named($name);
        }

        return $role;
    }
}
