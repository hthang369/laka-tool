<?php

namespace Modules\SystemManager\Repositories\Users;

use App\Models\Users\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laka\Core\Repositories\CoreRepository;
use Modules\SystemManager\Forms\Users\UserForm;
use Modules\SystemManager\Forms\Users\UserUpdatePasswordForm;
use Modules\SystemManager\Grids\Users\UserGrid;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereLikeClause;
use Modules\SystemManager\Entities\Roles\RoleModel;

class UserRepository extends CoreRepository
{
    protected $presenterClass = UserGrid::class;

    protected $filters = [
        'name' => WhereLikeClause::class,
        'email' => WhereLikeClause::class,
        'phone' => WhereLikeClause::class,
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        if (str_is(get_route_name(), 'user-management.update-password-form'))
            return UserUpdatePasswordForm::class;

        return UserForm::class;
    }

    public function show($id, $columns = [])
    {
        $data = parent::show($id, $columns);
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

        return $data;
    }

    public function update(array $attributes, $id)
    {
        if (!is_null($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        } else {
            $attributes = array_except($attributes, 'password');
        }
        $roles = array_pull($attributes, 'roles');
        $roleNames = array_map(function($item) {
            return RoleModel::findByLevel($item)->name;
        }, $roles);

        return DB::transaction(function () use ($attributes, $id, $roleNames) {
            $user = parent::update(array_filter($attributes), $id);
            $user->syncRoles($roleNames);
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
