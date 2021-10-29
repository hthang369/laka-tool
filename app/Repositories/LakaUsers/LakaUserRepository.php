<?php

namespace App\Repositories\LakaUsers;

use App\Facades\Common;
use App\Models\Companys\Company;
use App\Models\LakaUsers\LakaUser;
use App\Presenters\LakaUsers\LakaUserGridPresenter;
use App\Repositories\Companys\CompanyRepository;
use App\Repositories\Core\CoreRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Laka\Core\Http\Response\WebResponse;
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
            throw new \Exception(data_get($dataResponse, 'error_msg'));
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

    protected function addAllContacts($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-all-contacts-in-company', $data));
    }

    protected function addToAllRooms($data)
    {
        return $this->getReponseApiData(Common::callApi('post', '/api/v1/contact/add-to-all-rooms-by-company', $data));
    }

    public function disableUser($id, $attributes)
    {
        $codeDisableUser = Cache::get('codeDisableUser');
        $codeInput = (int)$attributes['code'];
        $typeAction = $attributes['type'];

        if ($typeAction !== 'sentmail' && $codeInput === $codeDisableUser && $typeAction === 'submit_code' && $codeInput > 999 && $codeInput <= 9999) {
            // Case Code hợp lệ
            Common::callApi('post', '/api/v1/user/delete-user', ['user_id' => $id]);

            return WebResponse::error(route('laka-user-management.user-disable'), ['saved' => true]);
        } else {
            // Trường hợp sai kết quả và resent
            if ($typeAction === 'submit_code' && $codeInput !== $codeDisableUser) {
                return WebResponse::error(route('laka-user-management.user-disable'), __('common.invalid_code'));
            } else {
                if ($typeAction === 'sentmail' || $typeAction === 'resent') {
                    // $this->sendCode($id);
                }
                // View::share('submitCode', 1);
                return view('user-management-for-app-chat/confirm_code');
            }

        }
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
