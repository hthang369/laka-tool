<?php

namespace App\Http\Controllers\LakaUsers;

use App\Http\Controllers\Core\CoreController;
use App\Repositories\LakaUsers\LakaUserRepository;
use App\Validators\LakaUsers\LakaUserValidator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laka\Core\Http\Response\WebResponse;

/**
 * Class LakaUserController
 * @package App\Http\Controllers\LakaUsers
 * @property LakaUserRepository lakauserRepository
 */
class LakaUserController extends CoreController
{
    protected $listViewName = [
        'index' => 'laka-user-management.list',
        'show' => 'laka-user-management.add_contact_update',
        'create' => 'laka-user-management.create',
        'store' => 'laka-user-management.add-contact',
        'update' => 'laka-user-management.add-contact',
        'resetPassword' => 'laka-user-management.add_contact_update',
        'disableUser' => 'laka-user-management.confirm_code'
    ];

    protected $permissionActions = [
        'disableUser' => 'edit'
    ];
    protected $errorRouteName = [
        'checkVerificationCode' => 'laka-user-management.disable-user',
        'resetPassword' => 'laka-user-management.edit',
    ];
    protected $messageResponse = [

    ];

    public function __construct(LakaUserValidator $validator)
    {
        parent::__construct($validator);
        $this->repository = $this->factory->makeRepository(LakaUserRepository::class);
        View::share('titlePage', __('users.laka.page_title'));
        View::share('headerPage', 'users.laka.page_header');
    }


    public function showUserDisable()
    {
        $data = $this->repository->showAllDeleteUser();
        return WebResponse::success('laka-user-management.list', $data);
    }

    public function showAddContact()
    {
        $data = $this->repository->showAllDeleteUser(false);
        return WebResponse::success('laka-user-management.list', $data);
    }

    public function checkVerificationCode($id)
    {
        $routeRedirect = $this->getErrorRouteName(__FUNCTION__, ['id' => $id]);
        $isSuccess = $this->repository->checkVerificationCode($id, request()->all());


        return $isSuccess ? WebResponse::created(route('laka-user-management.user-disable'),
            null, __('common.user_has_been_disabled')) :
            WebResponse::error($routeRedirect, true, __('common.invalid_code'));
    }

    public function disableUser($id)
    {
        View::share('titlePage', __('users.laka.confirm_code'));
        View::share('headerPage', 'users.laka.confirm_code');

        $userDisabled = $this->repository->disableUser($id, request()->all());
        data_set($userDisabled, 'id', $id);

        $msg = __('common.alert_sent_verification_code', ['email' => auth()->user()->email]);
        Session::flash('isAlert', true);
        return WebResponse::success($this->getViewName(__FUNCTION__), $userDisabled, $msg);
    }

    public function resetPassword($id)
    {
        $data = $this->repository->resetPassword($id);
        $data['id'] = $id;
        $errorRoute = $this->getErrorRouteName(__FUNCTION__, ['id' => $id]);

        if ($data['error_code'] != 0) {
            return WebResponse::error($errorRoute, true, $data['error_msg']);
        } else {
            return WebResponse::created(route('laka-user-management.edit', ['id' => $id]), $data, trans('common.reset_password_success'));
        }


    }
}
