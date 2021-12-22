<?php

return [
    [
        'code' => 'user-management',
        'name' => 'index',
        'children' => ['index', 'create']
    ],
    [
        'code' => 'bussiness-plan',
        'name' => 'index',
        'children' => ['index', 'create']
    ],
    [
        'code' => 'company',
        'name' => 'index',
        'children' => ['index', 'create']
    ],
    [
        'code' => 'role-management',
        'name' => 'index',
        'children' => ['index', 'create']
    ],
    [
        'code' => 'laka-user-management',
        'name' => 'index',
        'children' => ['index', 'user-disable', 'create', 'add-contact']
    ],
    [
        'code' => 'version',
        'name' => 'index',
        'children' => []
    ],
    [
        'code' => 'version-deploy',
        'name' => 'development',
        'children' => ['development', 'staging', 'production', 'log-release']
    ],
    [
        'code' => 'laka-log',
        'name' => 'index',
        'children' => ['index', 'create', 's3-log-list']
    ],
    [
        'code' => 'repair-data',
        'name' => 'index',
        'children' => ['index']
    ]
];
