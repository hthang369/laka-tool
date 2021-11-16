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
        'disableUser' => 'laka-user-management.confirm_code'
    ];

    protected $permissionActions = [
        'disableUser' => 'edit'
    ];
    protected $errorRouteName = [
        'checkVerificationCode' => 'laka-user-management.disable-user'
    ];
    protected $messageResponse = [

    ];

    public function __construct(LakaUserValidator $validator)
    {
        parent::__construct($validator);

        $this->repository = $this->factory->makeRepository(LakaUserRepository::class);
    }

    public function index()
    {
        View::share('titlePage', __('users.laka.list_approval'));
        View::share('headerPage', 'users.laka.list_approval');
        return parent::index();
    }

    public function showUserDisable()
    {
        View::share('titlePage', __('users.laka.list_contact'));
        View::share('headerPage', 'users.laka.list_contact');
        $data = $this->repository->showAllDeleteUser();
        return WebResponse::success('laka-user-management.list', $data);
    }

    public function showAddContact()
    {
        View::share('titlePage', __('users.laka.contact_header'));
        View::share('headerPage', 'users.laka.contact_header');
        $data = $this->repository->showAllDeleteUser(false);
        return WebResponse::success('laka-user-management.list', $data);
    }

    public function show($id)
    {
        View::share('titlePage', __('users.laka.contact_header'));
        View::share('headerPage', 'users.laka.contact_header');
        return parent::show($id);
    }

    public function create()
    {
        View::share('titlePage', __('users.laka.list_contact'));
        View::share('headerPage', 'users.laka.list_contact');
        return parent::create();
    }

    public function checkVerificationCode($id)
    {
        View::share('titlePage', __('users.laka.confirm_code'));
        View::share('headerPage', 'users.laka.confirm_code');

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
}
