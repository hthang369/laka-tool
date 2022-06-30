<?php

namespace Modules\LakaManager\Repositories\LakaUsers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\MessageBag;
use Modules\LakaManager\Entities\LakaUsers\LakaUserModel;
use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Traits\Pagination\BuildPaginator;
use Modules\Common\Facades\Common;
use Modules\Common\Repositories\BaseClientCriteria;
use Modules\Common\Repositories\Filters\SortByClientClause;
use Modules\Common\Repositories\Filters\WhereLikeClientClause;
use Modules\LakaManager\Entities\Companys\CompanyModel;
use Modules\LakaManager\Events\SendConfirmEmail;
use Modules\LakaManager\Forms\LakaUsers\LakaUserDisableForm;
use Modules\LakaManager\Forms\LakaUsers\LakaUserForm;
use Modules\LakaManager\Grids\LakaUsers\LakaUserApprovalApiTokenGrid;
use Modules\LakaManager\Grids\LakaUsers\LakaUserGrid;
use Modules\LakaManager\Repositories\Companys\CompanyRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class LakaUserRepository extends CoreRepository
{
    use BaseClientCriteria;

    protected $modelClass = LakaUserModel::class;

    protected $filters = [
        'sort' => SortByClientClause::class,
        'name' => WhereLikeClientClause::class,
        'email' => WhereLikeClientClause::class,
        'company' => WhereLikeClientClause::class,
        'id'    => WhereLikeClientClause::class,
        'user_type'    => WhereLikeClientClause::class,
        'is_bot'    => WhereLikeClientClause::class,
    ];

    private $cache_key = 'list_user_delete';

    public function bootPresenterDataGrid()
    {
        if (str_is(get_route_name(), 'laka-user-management.index')) {
            $this->presenterClass = LakaUserApprovalApiTokenGrid::class;
        } else {
            $this->presenterClass = LakaUserGrid::class;
        }
        parent::bootPresenterDataGrid();
    }

    public function form()
    {
        if (str_is(get_route_name(), 'laka-user-management.disable-user'))
            return LakaUserDisableForm::class;
        else
            return LakaUserForm::class;
    }

    protected function paginateData($data = null, $method = "paginate", $limit = null, $columns = [])
    {
        $results = Common::callApi('get', '/api/v1/api-token/get-list-approval')->toArray();
        $results['data'] = $this->filterByRequest($results['data']);
        return parent::paginateData($this->getReponseApiData($results), 'paginateClient', $limit, $columns);
    }

    public function showAllDeleteUser($allDisable = true)
    {
        $results = Common::callApi('get', '/api/v1/user/get-list-delete-user')->toArray();
        if (!$allDisable) {
            $results['data'] = array_filter($results['data'], function ($item) {
                return $item['disabled'] === 0;
            });
        }
        $results['data'] = $this->filterByRequest($results['data']);
        $results = parent::paginateData($this->getReponseApiData($results), 'paginateClient');
        return $this->parserResult($results);
    }

    public function show($id, $columns = [])
    {
        $userData = $this->getUserDetail($id);
        data_set($userData, 'btn_user_type', [
            'value' => ($userData['user_type'] == 0 ? 'admin' : 'default'),
            'text' => ($userData['user_type'] == 0 ? trans('users.laka.update_user_admin') : trans('users.laka.update_user_default'))
        ]);
        data_set($userData, 'user_type', $userData['user_type'] == 1 ? trans('users.laka.user_admin') : trans('users.laka.user_default'));
        data_set($userData, 'is_bot', $userData['is_bot'] == 1 ? trans('users.laka.is_user_bot') : trans('users.laka.user_default'));

        $companyList = resolve(CompanyRepository::class)->pluck('company.name', 'company.id');
        data_set($userData, 'id', $id);
        data_set($userData, 'company_list', $companyList);
        $company = CompanyModel::find(data_get($userData, 'company'), ['id', 'name']);

        data_set($userData, 'company_id', data_get($company, 'id'));
        data_set($userData, 'company', data_get($company, 'name'));

        return $userData;
    }

    public function disableUser($id, $attributes)
    {
        $typeAction = $attributes['type'];
        $arrayAction = ['sent-mail', 'resent'];
        $userDisabled = $this->getUserDetail($id);
        data_set($userDisabled, 'id', $id);

        if (in_array($typeAction, $arrayAction)) {
            $dataContentConfirm = array();
            $dataContentConfirm = $this->getConfirmDeleteUser($id);
            $warningExpired = $this->warningExpired(config('laka.time_expired_code'));

            data_set($dataContentConfirm, 'warningExpired', $warningExpired);
            (event(new SendConfirmEmail($userDisabled, $dataContentConfirm)));
        }

        return $userDisabled;
    }

    public function create(array $attributes)
    {
        if (is_null($attributes['is_user_bot'])) {
            $attributes['is_user_bot'] = 0;
        }
        $company = CompanyModel::find($attributes['company_id'], ['name', 'id']);
        $attributes['company'] = $company->id;
        $data = array_except($attributes, ['_token', 'company_id', 'add_all_contacts', 'add_to_all_rooms']);

        $dataResponse = Common::callApi('post', '/api/v1/user/register-users', $data);

        if (data_get($dataResponse, 'error_code') != 0) {
            throw new ValidatorException(new MessageBag(['email' => data_get($dataResponse, 'error_msg')]));
        }
        $userId = data_get($dataResponse, 'data.id');
        $this->addContactOption($attributes, $userId);

        return true;
    }

    public function update($attributes, $id)
    {
        $user = $this->getUserDetail($id);
        if ($user['disabled'] == 1) {
            throw new \Exception(trans('users.validator.user_has_been_disabled'));
        }
        $arrMapOption = [
            'addAllContacts' => 'add-all-contact',
            'addToAllRooms' => 'add-all-room',
            'setUserAdmin' => 'set-user-admin',
            'setUserDefault' => 'set-user-default'
        ];
        $addContactOption = $attributes['add-contact-option'];
        $methodName = array_search($addContactOption, $arrMapOption);
        if ($methodName) {
            $result = $this->$methodName(['user_id' => $id, 'company_id' => $attributes['company_id']]);
        }

        return $result;
    }

    public function resetPassword($id)
    {
        $apiAdress = '/api/v1/user/force-reset-password';
        $data['user_id'] = $id;
        return Common::callApi('post', $apiAdress, $data)->toArray();
    }

    protected function addContactOption($attributes, $userId)
    {
        foreach ($attributes['add_contact_option'] as $option) {
            if ($option == 'add_all_contacts') {
                $this->addAllContacts(['user_id' => $userId, 'company_id' => $attributes['company_id']]);

            }
            if ($option == 'add_to_all_rooms') {
                $this->addToAllRooms(['user_id' => $userId, 'company_id' => $attributes['company_id']]);
            }
        }
    }

    protected function addAllContacts($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-all-contacts-in-company', $data));
    }

    protected function addToAllRooms($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-to-all-rooms-by-company', $data));
    }

    private function setUserType($data)
    {
        array_forget($data, 'company_id');
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/user/set-user-admin-company', $data));
    }

    public function setUserAdmin($data)
    {
        return $this->setUserType(array_add($data, 'admin', true)) ? 'admin' : false;
    }

    public function setUserDefault($data)
    {
        return $this->setUserType(array_add($data, 'admin', false)) ? 'default' : false;
    }

    public function approvalToken($id)
    {
        $data = ['id' => $id];
        $result = Common::callApi('post', ' /api/v1/api-token/approve-token', $data)->toArray();
        return $result;
    }

    public function stopToken($id)
    {
        $data = ['id' => $id];
        $result = Common::callApi('post', '/api/v1/api-token/stop-token', $data)->toArray();
        return $result;
    }

    public function delete($id)
    {
        $data = ['id' => $id,];
        $result = Common::callApi('post', '/api/v1/api-token/delete-token', $data)->toArray();
        return $result;
    }

    public function checkVerificationCode($id, $attributes)
    {
        $codeDisableUser = Cache::get('codeDisableUser');
        $codeInput = (int)$attributes['code'];

        if ($codeDisableUser === $codeInput) {
            Common::callApi('post', '/api/v1/user/delete-user', ['user_id' => $id]);
            $this->resetCacheData('codeDisableUser');
            return true;
        }
        return false;
    }

    public function getConfirmDeleteUser($id)
    {
        $data = Common::callApi('post', '/api/v1/user/check-status-delete-user', ['user_id' => $id]);
        return data_get($data->toArray(), 'data');
    }

    private function warningExpired($config)
    {
        return __('common.expired_code', ['time' => (int)$config / 60]);
    }

    private function getUserDetail($id)
    {
        $data = Common::callApi('get', "/api/v1/user/get-detail-user/{$id}");
        return $data->toArray();
    }

    private function getReponseApiData($result)
    {
        if (!data_get($result, 'error_code')) {
            return data_get($result, 'data');
        } else {
            return $result;
        }
        return [];
    }

    private function resetCacheData($cacheKey)
    {
        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
        }
    }
}
