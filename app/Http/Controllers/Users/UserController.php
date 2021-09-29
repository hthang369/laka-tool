<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\Users\UserRepository;
use App\Validators\Users\UserValidator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\MessageBag;

use Laka\Core\Http\Response\WebResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\Users
 * @property UserRepository userRepository
 */
class UserController extends CoreController
{
    protected $listViewName = [
        'index'               => 'user-management.list',
        'create'              => 'user-management.create',
        'edit'                => 'user-management.update',
        'show'                => 'user-management.detail',
        'update'              => 'user-management.index',
        'store'               => 'user-management.index',
        'showUpdatePassword'  => 'user-management.update_password_form',
        'updatePassword'      => 'user-management.index',
    ];

    protected $errorRouteName = [
        'store'     => 'user-management.create',
        'update'    => 'user-management.edit',
        'updatePassword' => 'user-management.update-password',
    ];

    public function __construct(UserValidator $validator)
    {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(UserRepository::class);

        View::share('titlePage', __('users.page_title'));
        View::share('headerPage', 'users.page_header');
    }

    public function showUpdatePassword()
    {
        return WebResponse::success($this->getViewName(__FUNCTION__), null);
    }

    public function updatePassword()
    {
        $this->validator(request()->all(), UserValidator::RULE_UPDATE_PASSWORD);

        $this->repository->updatePassword(request('new_password'), user_get('id'));

        return WebResponse::updated(
            route($this->getViewName(__FUNCTION__), null),
            null,
            trans('common.update_password_success')
        );
    }
}
