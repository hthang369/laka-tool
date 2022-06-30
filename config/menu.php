<?php

return [
    [
        'group' => 'system-management',
        'name' => 'menu.system_management',
        'children' => [
            [
                'group' => 'user-management',
                'name' => 'menu.user_management',
                'link' => 'user-management.index'
            ],
            [
                'group' => 'role-management',
                'name' => 'menu.role_management',
                'link' => 'role-management.index'
            ],
            [
                'group' => 'version',
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
                'name' => 'menu.bussiness_plan',
                'link' => 'bussiness-plan.index'
            ],
            [
                'group' => 'company',
                'name' => 'menu.company',
                'link' => 'company.index'
            ],
            [
                'group' => 'laka-user-management',
                'name' => 'menu.laka_user_management',
                'children' => [
                    [
                        'group' => 'laka-user-management',
                        'name' => 'menu.laka_user_management_group.approval_token',
                        'link' => 'laka-user-management.index'
                    ],
                    [
                        'group' => 'laka-user-management',
                        'name' => 'menu.laka_user_management_group.user_disable',
                        'link' => 'laka-user-management.user-disable'
                    ],
                    [
                        'group' => 'laka-user-management',
                        'name' => 'menu.laka_user_management_group.add_contact',
                        'link' => 'laka-user-management.add-contact'
                    ],
                ]
            ],
            [
                'group' => 'version-deploy',
                'name' => 'menu.version_deploy',
                'children' => [
                    [
                        'group' => 'version-deploy',
                        'name' => 'menu.version_deploy_group.development',
                        'link' => 'version-deploy.development'
                    ],
                    [
                        'group' => 'version-deploy',
                        'name' => 'menu.version_deploy_group.staging',
                        'link' => 'version-deploy.staging'
                    ],
                    [
                        'group' => 'version-deploy',
                        'name' => 'menu.version_deploy_group.production',
                        'link' => 'version-deploy.production'
                    ],
                    [
                        'group' => 'version-deploy',
                        'name' => 'menu.version_deploy_group.log_release',
                        'link' => 'version-deploy.log-release'
                    ]
                ]
            ],
            [
                'group' => 'laka-log',
                'name' => 'menu.laka_log',
                'children' => [
                    [
                        'group' => 'laka-log',
                        'name' => 'menu.laka_log_group.local_log',
                        'link' => 'laka-log.index'
                    ],
                    [
                        'group' => 'laka-log',
                        'name' => 'menu.laka_log_group.log_parse',
                        'link' => 'laka-log.create'
                    ],
                    [
                        'group' => 'laka-log',
                        'name' => 'menu.laka_log_group.s3_log',
                        'link' => 'laka-log.s3-log-list'
                    ]
                ]
            ],
            [
                'group' => 'repair-data',
                'name' => 'menu.repair_data',
                'link' => 'repair-data.index'
            ]
        ]
    ]
];
