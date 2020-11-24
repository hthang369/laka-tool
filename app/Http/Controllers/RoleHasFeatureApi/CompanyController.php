<?php

namespace App\Http\Controllers\RoleHasFeatureApi;

use App\Http\Controllers\Controller;
use App\Services\BusinessPlan\BusinessPlanService;
use App\Services\RoleHasFeatureApi\RoleHasFeatureApiService;
use Illuminate\Http\Request;

class RoleHasFeatureApiController extends Controller
{

    private $roleHasFeatureApiService;
    private $businessPlanService;

    public function __construct(RoleHasFeatureApiService $roleHasFeatureApiService, BusinessPlanService $businessPlanService)
    {
        $this->roleHasFeatureApiService = $roleHasFeatureApiService;
        $this->businessPlanService = $businessPlanService;
    }

    public function index()
    {
        $list = $this->roleHasFeatureApiService->getAll();
        return view('/role-has-feature-api/list')->with('list', $list);
    }

    public function detail($id)
    {
        $company = $this->roleHasFeatureApiService->getDetailById($id);

        if (is_null($company)) {
            abort(404,'Page not found');
        }

        return view('/role-has-feature-api/detail')->with('company', $company);
    }

    public function newForm() {
        $listBusinessPlan = $this->businessPlanService->getAllBusinessPlan();
        return view('/role-has-feature-api/add_form')->with(['isNew' => true, 'listBusinessPlan' => $listBusinessPlan]);
    }

    public function updateForm($id) {
        $company = $this->roleHasFeatureApiService->getById($id);

        $listBusinessPlan = $this->businessPlanService->getAllBusinessPlan();

        if (is_null($company)) {
            abort(404,'Page not found');
        }

        return view('/role-has-feature-api/add_form')->with(['company' => $company, 'listBusinessPlan' => $listBusinessPlan]);
    }

    public function register(Request $request)
    {

        $validator = $this->roleHasFeatureApiService->ruleCreateUpdate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $input = $request->all();

        try {

            $company = $this->roleHasFeatureApiService->create($input);
            return redirect()->intended('/system-admin/role-has-feature-api/detail/' . $company->id);
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function update($id, Request $request)
    {
        $company = $this->roleHasFeatureApiService->getById($id);

        if (is_null($company)) {
            abort(404,'Page not found');
        }

        $validator = $this->roleHasFeatureApiService->ruleCreateUpdate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $input = request()->except(['_token', 'role']);

        try {
            $company = $this->roleHasFeatureApiService->update($id, $input);
        } catch (\Exception $ex) {
            abort(500);
        }

        return redirect()->intended('/system-admin/role-has-feature-api/detail/' . $id);
    }

    public function delete($id)
    {
        $company = $this->roleHasFeatureApiService->getById($id);

        if (is_null($company)) {
            abort(404,'Page not found');
        }

        try {

            $this->roleHasFeatureApiService->delete($id);
        } catch (\Exception $ex) {
            abort(500);
        }

        return redirect()->intended('/system-admin/role-has-feature-api');
    }
}
