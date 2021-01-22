<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Services\Role\RoleService;
use App\Validations\RoleValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    private $roleService;
    private $roleValidation;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService, RoleValidation $roleValidation)
    {
        parent::__construct();
        $this->roleService = $roleService;
        $this->roleValidation = $roleValidation;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('/common/index_page_top_menu');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $data = $this->roleService->list($request);
        return view('/role/list')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $data = $this->roleService->detail($id);
        return view('/role/detail')->with('role', $data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newForm()
    {
        return view('/role/add_form');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateForm($id)
    {
        $data = $this->roleService->getById($id);

        if (is_null($data)) {
            abort(400, __('custom_message.role_plan_not_found'));
        }

        return view('/role/update_form')->with('role', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {

        $validator = $this->roleValidation->newValidate($request->all());

        if ($validator->fails()) {
            return redirect()->intended('/system-admin/role/new')->withInput()->withErrors($validator->errors());
        }

        $input = $request->all();

        try {

            $role = $this->roleService->create($input);
            return redirect()->intended('/system-admin/role/detail/' . $role->id)->with('saved', true);
        } catch (\Exception $ex) {
            abort(400,$ex->getMessage());
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $role = $this->roleService->getById($id);

        if (is_null($role)) {
            abort(400, __('custom_message.role_plan_not_found'));
        }

        if ($role->name == config('constants.name.role_permission_name')) {
            return redirect()->back()->with('errorCommon', __('custom_message.warning_role_system'));
        }

        $validator = $this->roleValidation->updateValidate($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->intended('/system-admin/role/new')->withInput()->withErrors($validator->errors());
        }

        $input = request()->except(['_token', 'role']);

        try {
            $role->update($input);
        } catch (\Exception $ex) {
            abort(400, $ex->getMessage());
        }

        return redirect()->intended('/system-admin/role/detail/' . $id)->with('saved', true);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $role = $this->roleService->getById($id);

        if (is_null($role)) {
            abort(400, __('custom_message.role_plan_not_found'));
        }

        if ($role->name == config('constants.name.role_permission_name')) {
            return redirect()->back()->with('errorCommon', __('custom_message.warning_role_system'));
        }

        DB::beginTransaction();
        try {

            $role->delete();
            $role->role_has_feature_api()->delete();
            $role->role_user()->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            abort(400, $ex->getMessage());
        }

        return redirect()->intended('/system-admin/role')->with('deleted', true);
    }
}
