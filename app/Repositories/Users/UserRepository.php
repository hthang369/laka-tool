<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Presenters\Users\UserGridPresenter;
use App\Repositories\Core\CoreRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Spatie\Permission\Models\Role;

class UserRepository extends CoreRepository
{
    protected $modelClass = User::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = UserGridPresenter::class;

    public function formGenerate()
    {
        $listRole = Role::all();
        return ['roles_all' => $listRole];
    }

    public function show($id, $columns = [])
    {
        $data = parent::show($id, $columns);
        $data['roles'] = $data->roles()->get()->pluck('name', 'id');
        $listRole = $this->formGenerate();
        $data['roles_all'] = $listRole['roles_all'];
        return $data;
    }

    public function update(array $attributes, $id)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return DB::transaction(function () use ($attributes, $id) {
            $user = parent::update(array_filter($attributes), $id);
            $roles = array_keys($attributes['roles']);
            $user->syncRoles($roles);
            return $user;
        });
    }

    public function create(array $attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return DB::transaction(function () use ($attributes) {
            $user = parent::create(array_filter($attributes));
            $roles = array_keys($attributes['roles']);
            $user->syncRoles($roles);
            return $user;
        });
    }

    public function updatePassword($password, $id)
    {
        return parent::update(['password' => Hash::make($password)], $id);
    }
}
