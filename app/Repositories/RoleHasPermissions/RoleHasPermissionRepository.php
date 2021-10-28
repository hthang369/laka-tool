<?php

namespace App\Repositories\RoleHasPermissions;

use App\Models\Permissions\RoleHasPermissions;
use App\Repositories\Core\CoreRepository;
use App\Presenters\RoleHasPermissions\RoleHasPermissionGridPresenter;
use Illuminate\Support\Facades\DB;
use Lampart\Hito\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionRepository extends CoreRepository
{
    protected $modelClass = RoleHasPermissions::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    protected $presenterClass = RoleHasPermissionGridPresenter::class;

    public function getDataByRole($role_id)
    {
        $actions = config('permission.actions');

        if (empty($actions)) {
            return [];
        }

        $actionTable = "SELECT 1 as action_id, '{$actions[0]}' as action_name";
        if (isset($actions[1])) {
            unset($actions[0]);
            foreach ($actions as $key => $action) {
                $actionTable .= " UNION SELECT {$key}, '{$action}'";
            }
        }

        $builder = clone $this->model;
        $results = $builder->select([DB::raw('IF(section_parent_id = @curID,@r:=@r+1,@r:=1) AS no'),
                    DB::raw('@curID := section_parent_id as parentID'),'sec.*'])
                ->fromSub(
                    $this->model->select(DB::raw("sections.id AS section_id,
                                                    0 AS section_parent_id,
                                                    sections.name AS section_name,
                                                    sections.code AS section_code,
                                                    sections.url AS section_url,
                                                    sections.api AS section_api,
                                                    CONCAT('{', GROUP_CONCAT(IF(role.permission_id IS NULL,
                                                    CONCAT('\"', action_table.action_name, '\"', ':', 0),
                                                    CONCAT('\"', action_table.action_name, '\"', ':', 1))
                                                    ORDER BY action_table.action_id SEPARATOR ','), '}') AS permission"))
                    ->from(DB::raw("({$actionTable}) action_table"))
                    ->crossJoin('sections')
                    ->leftJoin('permissions', DB::raw("CONCAT(action_table.action_name, '_', sections.code)"), '=', 'permissions.name')
                    ->leftJoin(DB::raw("(SELECT * FROM role_has_permissions WHERE role_id = {$role_id}) role"), function ($join) {
                        $join->on("role.permission_id", "=", 'permissions.id');
                    })
                    ->groupBy('sections.id', 'sections.name', 'sections.code', 'sections.url', 'sections.api')
                    // ->orderBy('sections.parent_id', 'ASC')
                    ->orderBy('sections.code', 'ASC')
                    ->orderBy('sections.id', 'ASC'),
                    'sec'
                )
                ->crossJoin(DB::raw('(SELECT @r:=0,@curID:=0) AS r'))
                ->get();

        $this->resetQuery();

        return $this->parserResult(['data' => $results, 'user_count' => Role::find($role_id)->users()->count()]);
    }

    public function update(array $attributes, $id)
    {
        $role = Role::find($id);
        $permissions = Permission::whereIn('name', array_keys(array_except(array_filter($attributes), ['_token'])))->get();
        $role->syncPermissions($permissions);
        return $role;
    }

}
