<?php

namespace Modules\LakaManager\Http\Controllers\LakaUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\LakaManager\Repositories\LakaUsers\LakaUserRepository;
use Modules\LakaManager\Validators\LakaUsers\LakaUserValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Prettus\Validator\Contracts\ValidatorInterface;

class LakaUserController extends CoreController
{
    protected $defaultName = 'laka-user';

    protected $listViewName = [
        'showUserDisable' => 'lakamanager::laka-user.list',
        'showAddContact' => 'lakamanager::laka-user.list',
        'resetPassword' => 'laka-user-management.add_contact_update',
        'disableUser' => 'lakamanager::laka-user.confirm_code',
        'approvalToken' => 'laka-user-management.index',
        'stopToken' => 'laka-user-management.index',
    ];

    protected $permissionActions = [
        'disableUser' => 'delete',
        'checkVerificationCode'=>'delete',
        'approvalToken'=>'edit',
        'stopToken'=>'edit',
    ];
    protected $errorRouteName = [
        'checkVerificationCode' => 'laka-user-management.disable-user',
        'resetPassword' => 'laka-user-management.edit',
        'update' => 'laka-user-management.update',
        'store' => 'laka-user-management.create',
        'approvalToken' => 'laka-user-management.index',
        'stopToken' => 'laka-user-management.index',
    ];

    public function __construct(LakaUserRepository $repository, LakaUserValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);

        View::share('titlePage', __('users.laka.page_title'));
        View::share('headerPage', 'users.laka.page_header');
    }

    public function showUserDisable(Request $request)
    {
        $data = $this->repository->showAllDeleteUser();
        return $this->responseView($request, $this->getData($data), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function showAddContact(Request $request)
    {
        $data = $this->repository->showAllDeleteUser(false);
        return $this->responseView($request, $this->getData($data), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function disableUser(Request $request, $id)
    {
        $userDisabled = $this->repository->disableUser($id, $request->all());
        list($modal, $form) = $this->formGenerateConfig(route($this->routeName.'.check-verification-code', $id), 'detail', ['model' => $userDisabled]);
        return $this->responseView($request, compact('modal', 'form'), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    public function checkVerificationCode(Request $request, $id)
    {
        $data = $request->all();
        $this->validator($data, 'RULE_CONFIRM');
        $isSuccess = $this->repository->checkVerificationCode($id, $data);
        return $this->responseAction($request, $isSuccess, 'data');
    }

    public function resendVerificationCode(Request $request, $id)
    {
        $userDisabled = $this->repository->disableUser($id, $request->all());
        return $this->responseAction($request, $userDisabled, 'data');
    }

    public function update(Request $request, $id)
    {
        $this->validator->setId($id);
        $this->validator($request->all(), ValidatorInterface::RULE_UPDATE);

        $data = $this->repository->update($request->all(), $id);
        // $errorRoute = $this->getErrorRouteName(__FUNCTION__, ['id' => $id]);

        if (!array_key_exists('error_code', $data)) {
            $msg = '';
            if (array_key_exists('user_had_added', $data)) {
                $totalUserAdded = count($data['user_had_added']);
                $msg = __('users.laka.add_all_contact_in_company', ['total' => $totalUserAdded]);
            } else {
                $msg = __('users.laka.set_success_user_type', ['userType' => $data]);
            }
            return $this->responseAction($request, $data, 'updated', '', $msg);
        } else {
            return $this->responseAction($request, $data, 'error', '', $data['error_msg']);
        }
    }

    public function resetPassword(Request $request, $id)
    {
        $data = $this->repository->resetPassword($id);
        $data['id'] = $id;
        $errorRoute = $this->getErrorRouteName(__FUNCTION__, ['id' => $id]);

        if ($data['error_code'] != 0) {
            return $this->responseAction($request, $data, 'error', '', $data['error_msg']);
        } else {
            return $this->responseAction($request, $data, 'created', '', trans('common.reset_password_success'));
        }
    }

    public function approvalToken(Request $request, $id)
    {
        $data = $this->repository->approvalToken($id);
        if ($data['error_code'] == 1) {
            return $this->responseAction($request, $data, 'error', '', $data['error_msg']);
        }
        if ($data['error_code'] == 0) {
            return $this->responseAction($request, $data, 'created', '', trans('users.laka.approval-token.activate'));
        }
    }

    public function stopToken(Request $request, $id)
    {
        $data = $this->repository->stopToken($id);
        if ($data['error_code'] == 1) {
            return $this->responseAction($request, $data, 'error', '', $data['error_msg']);
        }
        if ($data['error_code'] == 0) {
            return $this->responseAction($request, $data, 'created', '', trans('users.laka.approval-token.stop'));
        }
    }
}
