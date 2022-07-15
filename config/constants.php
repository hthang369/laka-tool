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
        ]
    ],
    'laka-user-disable' => [
        'user-disable' => [
            'text' => 'breadcrumb.laka_user_disable',
            'parent' => 'breadcrumb.laka_user_manager'
        ]
    ],
    'laka-user-company' => [
        'add-contact' => [
            'text' => 'breadcrumb.laka_user_contact',
            'parent' => 'breadcrumb.laka_user_manager'
        ]
    ],
    'version-deploy' => [
        'log-release' => [
            'text' => 'breadcrumb.deploy_log_release',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ],
    ],
    'deploy-development' => [
        'development' => [
            'text' => 'breadcrumb.deploy_development',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ]
    ],
    'deploy-staging' => [
        'staging' => [
            'text' => 'breadcrumb.deploy_staging',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ]
    ],
    'deploy-production' => [
        'production' => [
            'text' => 'breadcrumb.deploy_production',
            'parent' => 'breadcrumb.deploy_enviroment_manager'
        ]
    ],
    'laka-log' => [
        'index' => [
            'text' => 'breadcrumb.laka_log_report',
            'parent' => 'breadcrumb.laka_log_manager'
        ]
    ],
    'laka-parse-log' => [
        'index' => [
            'text' => 'breadcrumb.laka_log_parse',
            'parent' => 'breadcrumb.laka_log_manager'
        ],
    ],
    'laka-log-s3' => [
        's3-log-list' => [
            'text' => 'breadcrumb.laka_log_s3_list',
            'parent' => 'breadcrumb.laka_log_manager'
        ]
    ],
    'repair-data' => [
        'index' => 'breadcrumb.repair_data'
    ],
    'log-activity' => [
        'index' => 'breadcrumb.log_activity'
    ],
];
