<?php

namespace App\Repositories\LakaUsers;

use App\Events\sendConfirmEmail;
use App\Facades\Common;
use App\Models\Companys\Company;
use App\Models\LakaUsers\LakaUser;
use App\Presenters\LakaUsers\LakaUserGridPresenter;
use App\Repositories\Companys\CompanyRepository;
use App\Repositories\Core\CoreRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Laka\Core\Traits\BuildPaginator;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;

class LakaUserRepository extends CoreRepository
{
    use BuildPaginator;

    protected $modelClass = LakaUser::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = LakaUserGridPresenter::class;


    public function formGenerate()
    {
        $companyList = resolve(CompanyRepository::class)->pluck('company.name', 'company.id');
        return ['company_list' => $companyList->toArray()];
    }

    public function paginate($limit = null, $columns = [], $method = "paginate")
    {
        $results = Cache::remember('list_user_approval', config('constants.cache_expire'), function () {
            return Common::callApi('get', '/api/v1/api-token/get-list-approval')->toArray();
        });
        return $this->parserResult($results);
    }

    public function showAllDeleteUser($allDisable = true)
    {
        $results = Cache::remember('list_user_delete', config('constants.cache_expire'), function () {
            return Common::callApi('get', '/api/v1/user/get-list-delete-user')->toArray();
        });
        if (!$allDisable) {
            $results['data'] = array_filter($results['data'], function ($item) {
                return $item['disabled'] === 0;
            });
        }
        return $this->parserResult($results);
    }

    public function show($id, $columns = [])
    {
        $userData = $this->getUserDetail($id);
        $typeUser = data_get($userData, 'is_user_bot') == 1 ? trans('users.laka.is_user_bot') : trans('users.laka.user_default');
        data_set($userData, 'type_of_user', $typeUser);
        $companyList = resolve(CompanyRepository::class)->pluck('company.name', 'company.id');
        data_set($userData, 'id', $id);
        data_set($userData, 'company_list', $companyList);

        return $userData;
    }

    public function create(array $attributes)
    {
        if (is_null($attributes['is_user_bot'])) {
            $attributes['is_user_bot'] = 0;
        }
        $company = Company::find($attributes['company_id']);
        $attributes['company'] = $company->name;
        $data = array_except($attributes, ['_token', 'company_id', 'add_all_contacts', 'add_to_all_rooms']);

        $dataResponse = Common::callApi('post', '/api/v1/user/register-users', $data);
        if (data_get($dataResponse, 'error_code') != 0) {
            throw new \InvalidArgumentException(data_get($dataResponse, 'error_msg'));
        }
        $userId = data_get($dataResponse, 'data.id');
        if ($attributes['add_all_contacts'] == 1) {
            $this->addAllContacts(['user_id' => $userId, 'company_id' => $attributes['company_id']]);
        }
        if ($attributes['add_to_all_rooms'] == 1) {
            $this->addToAllRooms(['user_id' => $userId, 'company_id' => $attributes['company_id']]);
        }
        return true;
    }

    public function update(array $attributes, $id)
    {
        $user = $this->getUserDetail($id);
        if ($user['disabled'] == 1) {
            throw new \Exception(trans('users.validator.user_has_been_disabled'));
        }
        if ($attributes['add_all_contacts'] == 1) {
            $this->addAllContacts(['user_id' => $id, 'company_id' => $attributes['company_id']]);
        }
        if ($attributes['add_to_all_rooms'] == 1) {
            $this->addToAllRooms(['user_id' => $id, 'company_id' => $attributes['company_id']]);
        }
        return true;
    }

    public function resetPassword($id)
    {
        $apiAdress = '/api/v1/user/force-reset-password';
        $data['user_id'] = $id;
        return Common::callApi('post', $apiAdress, $data)->toArray();

    }

    protected function addAllContacts($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-all-contacts-in-company', $data));
    }

    protected function addToAllRooms($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-to-all-rooms-by-company', $data));
    }

    public function checkVerificationCode($id, $attributes)
    {
        $codeDisableUser = Cache::get('codeDisableUser');
        $codeInput = (int)$attributes['code'];

        if ($codeDisableUser === $codeInput) {
            Common::callApi('post', '/api/v1/user/delete-user', ['user_id' => $id]);
            return true;
        }
        return false;
    }

    public function disableUser($id, $attributes)
    {
        $typeAction = $attributes['type'];
        $arrayAction = ['sent-mail', 'resent'];
        $userDisabled = $this->getUserDetail($id);

        if (in_array($typeAction, $arrayAction)) {
            $dataContentConfirm = array();
            $dataContentConfirm = $this->getConfirmDeleteUser($id);
            $warningExpired = $this->warningExpired(config('laka.time_expired_code'));

            data_set($dataContentConfirm, 'warningExpired', $warningExpired);
            (event(new sendConfirmEmail($userDisabled, $dataContentConfirm)));
        }

        return $userDisabled;
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

    protected function parserResult($result)
    {
        $data = $this->getReponseApiData($result);
        $perPage = $this->getLimitForPagination();
        if (count($data) > 0) {
            $page = Paginator::resolveCurrentPage('page');
            return parent::parserResult($this->paginator(collect($data)->forPage($page, $perPage)->values(), count($data), $perPage, null, []));
        }
        return parent::parserResult($this->paginator($data, count($data), $perPage, null, []));
    }

    private function getReponseApiData($result)
    {
        if (!data_get($result, 'error_code')) {
            return data_get($result, 'data');
        }
        return [];
    }

}
