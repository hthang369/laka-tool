<?php

namespace Modules\SystemManager\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\SystemManager\Repositories\Users\UserRepository;
use Modules\SystemManager\Validators\Users\UserValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class UserController extends CoreController
{
    protected $defaultName = 'users';

    protected $listViewName = [
        'showUpdatePassword' => 'systemmanager::users.modify_modal',
    ];

    public function __construct(UserRepository $repository, UserValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('users.page_title'));
        View::share('headerPage', 'users.page_header');
    }

    public function showUpdatePassword(Request $request)
    {
        list($modal, $form) = $this->formGenerateConfig(route($this->routeName.'.update-password'), 'update', ['method' => 'put', 'title' => __('users.page_header_update_password')]);

        return $this->responseView($request, compact('modal', 'form'), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function updatePassword(Request $request)
    {
        $this->validator($request->all(), UserValidator::RULE_UPDATE_PASSWORD);

        $data = $this->repository->updatePassword(request('new_password'), user_get('id'));

        return $this->responseAction($request, $data, 'updated', '', trans('common.update_password_success'));
    }
}
