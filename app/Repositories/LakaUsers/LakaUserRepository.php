<?php

namespace App\Repositories\LakaUsers;

use App\Events\sendConfirmEmail;
use App\Facades\Common;
use App\Models\Companys\Company;
use App\Models\LakaUsers\LakaUser;
use App\Presenters\LakaUsers\LakaUserApprovalApiToken;
use App\Presenters\LakaUsers\LakaUserGridPresenter;
use App\Repositories\Companys\CompanyRepository;
use App\Repositories\Core\BaseClientCriteria;
use App\Repositories\Core\CoreRepository;
use App\Repositories\Core\Filters\SortByClientClause;
use App\Repositories\Core\Filters\WhereLikeClientClause;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\MessageBag;
use Laka\Core\Traits\Pagination\BuildPaginator;
use Prettus\Validator\Exceptions\ValidatorException;

class LakaUserRepository extends CoreRepository
{
    use BuildPaginator, BaseClientCriteria;

    protected $modelClass = LakaUser::class;

    protected $filters = [
        'sort' => SortByClientClause::class,
        'name' => WhereLikeClientClause::class,
        'email' => WhereLikeClientClause::class,
        'id'=>WhereLikeClientClause::class,
    ];

    private $cache_key = 'list_user_delete';

    public function bootPresenterDataGrid()
    {
        if (str_is(last(request()->segments()), 'laka-user-management')) {
            $this->presenterClass = LakaUserApprovalApiToken::class;
        } else {
            $this->presenterClass = LakaUserGridPresenter::class;
        }
        parent::bootPresenterDataGrid();
    }

    public function formGenerate()
    {
        $companyList = resolve(CompanyRepository::class)->pluck('company.name', 'company.id');
        return ['company_list' => $companyList->toArray()];
    }

    public function paginate($limit = null, $columns = [], $method = "paginate")
    {
        $results = Common::callApi('get', '/api/v1/api-token/get-list-approval')->toArray();
        $results['data'] = $this->filterByRequest($results['data']);
        return $this->parserResult($results);
    }

    public function approvalToken($id)
    {
        $data = ['id' => $id];
        $result = Common::callApi('post', ' /api/v1/api-token/approve-token', $data)->toArray();
        $this->resetCacheData();
        return $result;
    }

    public function stopToken($id)
    {
        $data = ['id' => $id];
        $result = Common::callApi('post', '/api/v1/api-token/stop-token', $data)->toArray();
        $this->resetCacheData();
        return $result;
    }

    public function delete($id)
    {
        $data = ['id' => $id,];
        $result = Common::callApi('post', '/api/v1/api-token/delete-token', $data)->toArray();
        $this->resetCacheData();
        return $result;
    }

    public function showAllDeleteUser($allDisable = true)
    {
        $results = Cache::remember($this->cache_key, config('constants.cache_expire'), function () {
            return Common::callApi('get', '/api/v1/user/get-list-delete-user')->toArray();
        });
        if (!$allDisable) {
            $results['data'] = array_filter($results['data'], function ($item) {
                return $item['disabled'] === 0;
            });
        }
        $results['data'] = $this->filterByRequest($results['data']);
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
        $company = Company::find(data_get($userData, 'company'), ['id', 'name']);

        data_set($userData, 'company_id', data_get($company, 'id'));
        data_set($userData, 'company', data_get($company, 'name'));

        return $userData;
    }

    public function create(array $attributes)
    {
        if (is_null($attributes['is_user_bot'])) {
            $attributes['is_user_bot'] = 0;
        }
        $company = Company::find($attributes['company_id'], ['name', 'id']);
        $attributes['company'] = $company->id;
        $data = array_except($attributes, ['_token', 'company_id', 'add_all_contacts', 'add_to_all_rooms']);

        $dataResponse = Common::callApi('post', '/api/v1/user/register-users', $data);

        if (data_get($dataResponse, 'error_code') != 0) {
            throw new ValidatorException(new MessageBag(['email' => data_get($dataResponse, 'error_msg')]));
        }
        $userId = data_get($dataResponse, 'data.id');
        $this->addContactOption($attributes, $userId);
        $this->resetCacheData();

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
        ];
        $addContactOption = $attributes['add-contact-option'];
        $methodName = array_search($addContactOption, $arrMapOption);
        if ($methodName) {
            $result = $this->$methodName(['user_id' => $id, 'company_id' => $attributes['company_id']]);
        }
        $this->resetCacheData();

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

    public function checkVerificationCode($id, $attributes)
    {
        $codeDisableUser = Cache::get('codeDisableUser');
        $codeInput = (int)$attributes['code'];

        if ($codeDisableUser === $codeInput) {
            Common::callApi('post', '/api/v1/user/delete-user', ['user_id' => $id]);
            $this->resetCacheData();
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
        $total = count($data);
        $perPage = $this->getLimitForPagination();
        if (count($data) > 0) {
            $page = Paginator::resolveCurrentPage('page');
            $data = collect($data)->forPage($page, $perPage)->values();
        }
        $pagination = $this->paginator($data, $total, $perPage, null, []);
        $pagination->appends(request()->all());
        return parent::parserResult($pagination);
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

    private function resetCacheData()
    {
        if (Cache::has($this->cache_key)) {
            Cache::forget($this->cache_key);
        }
    }
}
