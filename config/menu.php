<?php

return [
    [
        'group' => 'system-management',
        'name' => 'menu.system_management',
        'children' => [
            [
                'group' => 'user-management',
                'section_code' => 'user-management',
                'name' => 'menu.user_management',
                'link' => 'user-management.index'
            ],
            [
                'group' => 'role-management',
                'section_code' => 'role-management',
                'name' => 'menu.role_management',
                'link' => 'role-management.index'
            ],
            [
                'group' => 'version',
                'section_code' => 'version',
                'name' => 'menu.version',
                'link' => 'version.index'
            ]
        ]
    ],
    [
        'group' => 'laka-management',
        'name' => 'menu.laka_management',
        'children' => [
            [
                'group' => 'bussiness-plan',
                'section_code' => 'bussiness-plan',
                'name' => 'menu.bussiness_plan',
                'link' => 'bussiness-plan.index'
            ],
            [
                'group' => 'company',
                'section_code' => 'company',
                'name' => 'menu.company',
                'link' => 'company.index'
            ],
            [
                'group' => 'laka-user-management',
                'section_code' => 'laka-user-management',
                'name' => 'menu.laka_user_management',
                'children' => [
                    [
                        'group' => 'laka-user-management',
                        'section_code' => 'laka-user-management',
                        'name' => 'menu.laka_user_management_group.approval_token',
                        'link' => 'laka-user-management.index'
                    ],
                    [
                        'group' => 'laka-user-management',
                        'section_code' => 'laka-user-disable',
                        'name' => 'menu.laka_user_management_group.user_disable',
                        'link' => 'laka-user-disable.user-disable'
                    ],
                    [
                        'group' => 'laka-user-management',
                        'section_code' => 'laka-user-company',
                        'name' => 'menu.laka_user_management_group.add_contact',
                        'link' => 'laka-user-company.add-contact'
                    ],
                ]
            ],
            [
                'group' => 'deploy',
                'section_code' => 'version-deploy',
                'name' => 'menu.version_deploy',
                'children' => [
                    [
                        'group' => 'deploy',
                        'section_code' => 'deploy-development',
                        'name' => 'menu.version_deploy_group.development',
                        'link' => 'deploy-development.development'
                    ],
                    [
                        'group' => 'deploy',
                        'section_code' => 'deploy-staging',
                        'name' => 'menu.version_deploy_group.staging',
                        'link' => 'deploy-staging.staging'
                    ],
                    [
                        'group' => 'deploy',
                        'section_code' => 'deploy-production',
                        'name' => 'menu.version_deploy_group.production',
                        'link' => 'deploy-production.production'
                    ],
                    [
                        'group' => 'deploy',
                        'section_code' => 'version-deploy',
                        'name' => 'menu.version_deploy_group.log_release',
                        'link' => 'version-deploy.log-release'
                    ]
                ]
            ],
            [
                'group' => 'laka-log',
                'section_code' => 'laka-log',
                'name' => 'menu.laka_log',
                'children' => [
                    [
                        'group' => 'laka-log',
                        'section_code' => 'laka-log',
                        'name' => 'menu.laka_log_group.local_log',
                        'link' => 'laka-log.index'
                    ],
                    [
                        'group' => 'laka-log',
                        'section_code' => 'laka-parse-log',
                        'name' => 'menu.laka_log_group.log_parse',
                        'link' => 'laka-parse-log.index'
                    ],
                    [
                        'group' => 'laka-log',
                        'section_code' => 'laka-log-s3',
                        'name' => 'menu.laka_log_group.s3_log',
                        'link' => 'laka-log-s3.s3-log-list'
                    ]
                ]
            ],
            [
                'group' => 'repair-data',
                'section_code' => 'repair-data',
                'name' => 'menu.repair_data',
                'link' => 'repair-data.index'
            ]
        ]
    ]
];
