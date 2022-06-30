<?php

return [
    'version' => [
        'index' => 'breadcrumb.version'
    ],
    'role-management' => [
        'index' => 'breadcrumb.role'
    ],
    'user-management' => [
        'index' => 'breadcrumb.user'
    ],
    'bussiness-plan' => [
        'index' => 'breadcrumb.business_plan'
    ],
    'company' => [
        'index' => 'breadcrumb.company'
    ],
    'laka-user-management' => [
        'index' => [
            'text' => 'breadcrumb.laka_user_token',
            'parent' => 'breadcrumb.laka_user_manager'
        ],
        'user-disable' => [
            'text' => 'breadcrumb.laka_user_disable',
            'parent' => 'breadcrumb.laka_user_manager'
        ],
        'add-contact' => [
            'text' => 'breadcrumb.laka_user_contact',
            'parent' => 'breadcrumb.laka_user_manager'
        ]
    ],
    'version-deploy' => [
        'development' => [
            'text' => 'breadcrumb.deploy_development',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ],
        'staging' => [
            'text' => 'breadcrumb.deploy_staging',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ],
        'production' => [
            'text' => 'breadcrumb.deploy_production',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ],
        'log-release' => [
            'text' => 'breadcrumb.deploy_log_release',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ],
    ],
    'laka-log' => [
        'index' => [
            'text' => 'breadcrumb.laka_log_report',
            'parent' => 'breadcrumb.laka_log_manager'
        ],
        'create' => [
            'text' => 'breadcrumb.laka_log_parse',
            'parent' => 'breadcrumb.laka_log_manager'
        ],
        's3-log-list' => [
            'text' => 'breadcrumb.laka_log_s3_list',
            'parent' => 'breadcrumb.laka_log_manager'
        ],
    ],
    'repair-data' => [
        'index' => 'breadcrumb.repair_data'
    ]
];
