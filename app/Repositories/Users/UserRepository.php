<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Presenters\Users\UserGridPresenter;
use App\Repositories\Core\CoreRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laka\Core\Repositories\FilterQueryString\Filters\FullTextSearchClause;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Spatie\Permission\Models\Role;

class UserRepository extends CoreRepository
{
    protected $modelClass = User::class;

    protected $filters = [
        'name' => FullTextSearchClause::class,
        'email' => WhereLikeClause::class,
        'phone' => WhereLikeClause::class,
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
        $data['role_rank'] = $data->roles()->min('role_rank');
        $data['isShowBtnUpdate'] = true;

        $isUserSystemAdmin = user_get()->is_user_sa;

        // Check role if with route edit
        if (str_is(last(request()->segments()), 'edit')) {
            if ($data['status'] == 1 && !$isUserSystemAdmin) {
                throw new AuthorizationException();
            } elseif ($data['status'] != 1 && user_get()->highest_role > $data['role_rank']) {
                throw new AuthorizationException();
            }
        }
        if ($data['status'] == 1 && !$isUserSystemAdmin) {
            $data['isShowBtnUpdate'] = false;
        }
        if ($data['status'] != 1 && user_get()->highest_role  > $data['role_rank']) {
            $data['isShowBtnUpdate'] = false;
        }

        $listRole = $this->formGenerate();
        $data['roles_all'] = $listRole['roles_all'];
        return $data;
    }

    public function update(array $attributes, $id)
    {
        if (!is_null($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        } else {
            $attributes = array_except($attributes, 'password');
        }

        return DB::transaction(function () use ($attributes, $id) {
            $user = parent::update(array_filter($attributes), $id);
            $user->syncRoles($attributes['roles']);
            return $user;
        });
    }

    public function create(array $attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return DB::transaction(function () use ($attributes) {
            $user = parent::create(array_filter($attributes));
            $user->syncRoles($attributes['roles']);
            return $user;
        });
    }

    public function updatePassword($password, $id)
    {
        return parent::update(['password' => Hash::make($password)], $id);
    }
}
