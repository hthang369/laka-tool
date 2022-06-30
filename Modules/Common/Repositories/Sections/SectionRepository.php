<?php

namespace Modules\Common\Repositories\Sections;

use Laka\Core\Repositories\BaseRepository;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Illuminate\Support\Facades\DB;
use Laka\Core\Permissions\Sections;

class SectionRepository extends BaseRepository
{
    protected $modelClass = Sections::class;

    protected $filters = [
        'name' => WhereClause::class
    ];

    public function getDataByPermissionUserId($userId)
    {
        return $this->model::select(['sections.code'])->distinct()
            ->join('permissions', function($join) {
                $join->on(DB::raw("SUBSTRING_INDEX(permissions.`name`, '_', -1)"), '=', 'sections.code');
            })
            ->join('role_has_permissions as rhp', 'rhp.permission_id', '=', 'permissions.id')
            ->join('user_has_roles as uhr', 'uhr.role_id', '=', 'rhp.role_id')
            ->join('users', 'users.id', '=', 'uhr.model_id')
            ->where('users.id', '=', $userId)
            ->where(DB::raw("SUBSTRING_INDEX(permissions.`name`, '_', 1)"), '=', 'view')
            ->get();
    }
}
