<?php

return [
    /*
     * Sections list screens
     */
    'sections' => [
        ['name'=> 'company', 'code' => 'company', 'url' => '', 'api' => ''],
        ['name'=> 'bussiness-plan', 'code' => 'bussiness-plan', 'url' => '', 'api' => ''],
        ['name'=> 'user-management', 'code' => 'user-management', 'url' => '', 'api' => ''],
        ['name'=> 'laka-user-management', 'code' => 'laka-user-management', 'url' => '', 'api' => ''],
        ['name'=> 'role-management', 'code' => 'role-management', 'url' => '', 'api' => ''],
        ['name'=> 'version', 'code' => 'version', 'url' => '', 'api' => ''],
        ['name'=> 'version-deploy', 'code' => 'version-deploy', 'url' => '', 'api' => ''],
        ['name'=> 'permission-role', 'code' => 'permission-role', 'url' => '', 'api' => ''],
        ['name'=> 'laka-log', 'code' => 'laka-log', 'url' => '', 'api' => ''],
    ],
    /*
     * permission actions
     */
    'actions' => ['public', 'view', 'add', 'edit', 'delete', 'download', 'upload', 'print'],

    /**
     * Some sections only have a few actions, list them here
     */
    'section_action' => [
        'company'               => ['view', 'add', 'edit', 'delete'],
        'bussiness-plan'        => ['view', 'add', 'edit', 'delete'],
        'user-management'       => ['view', 'add', 'edit', 'delete'],
        'laka-user-management'  => ['view', 'add', 'edit', 'delete'],
        'role-management'       => ['view', 'add', 'edit', 'delete'],
        'version'               => ['view', 'add', 'edit', 'delete'],
        'version-deploy'        => ['view', 'add'],
        'permission-role'       => ['view', 'edit'],
        'laka-log'              => ['view', 'add', 'delete', 'download'],
    ],

    'custom_section_action' => [
    ],

    /*
     * Abilities: maps action controller with permission actions
     */
    'abilities' =>  [
        'index'     => 'view',
        'edit'      => 'edit',
        'show'      => 'view',
        'update'    => 'edit',
        'create'    => 'add',
        'store'     => 'add',
        'destroy'   => 'delete',
        'download'  => 'download',
        'upload'    => 'upload',
        'print'     => 'print',
    ],
    /*
     * Roles default
     * important !! index 0 need be System Admin, will set all permissions by default
     */
    'roles' => [
        ['level' => 'L1', 'name' => 'System Admin', 'description' => 'Role For Set Permission', 'guard_name'=> 'web', 'role_rank' => 1],
        ['level' => 'L2', 'name' => 'Admin', 'description' => 'Admin', 'guard_name'=> 'web', 'role_rank' => 2],
        ['level' => 'L3', 'name' => 'Member', 'description' => 'Member', 'guard_name'=> 'web', 'role_rank' => 3],
        ['level' => 'L4', 'name' => 'Staff', 'description' => 'System operator', 'guard_name'=> 'web', 'role_rank' => 4],
    ],
    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'user_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'user_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',
    ],

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * When checking for a permission against a model by passing a Permission
         * instance to the check, this key determines what attribute on the
         * Permissions model is used to cache against.
         *
         * Ideally, this should match your preferred way of checking permissions, eg:
         * `$user->can('view-posts')` would be 'name'.
         */

        'model_key' => 'name',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
