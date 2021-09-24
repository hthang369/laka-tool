<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\Users\UserRepository;
use App\Validators\Users\UserValidator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function __construct(UserValidator $validator) {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(UserRepository::class);

        View::share('titlePage', __('users.page_title'));
        View::share('headerPage', 'users.page_header');
    }

    public function showUpdatePassword() {
        return WebResponse::success($this->getViewName(__FUNCTION__), null);
    }
 
    public function updatePassword() {   
        $currentPassword = request('current_password');
        $newPassword = request('new_password');
        $confirmPassword = request('confirm_password');
        
        $user = Auth::user();
        $user->password = Hash::make($newPassword); 
        $user->save(); 
         
        return WebResponse::updated(
            route($this->getViewName(__FUNCTION__), null), 
            null, 
            trans('common.update_password_success')
        );
    }
}
