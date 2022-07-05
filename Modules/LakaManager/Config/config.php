<?php

return [
    'name' => 'LakaManager',
    'serverList' => [
        [
            'id' => 'api',
            'name' => 'Api',
            'color' => 'primary',
        ],
        [
            'id' => 'frontend',
            'name' => 'Frontend',
            'color' => 'secondary',
        ],
        [
            'id' => 'backend',
            'name' => 'Backend',
            'color' => 'dark',
        ],
        [
            'id' => 'socket',
            'name' => 'Socket',
            'color' => 'success',
        ],
    ],
    'releaseTypes' => [
        [
            'id' => 'New',
            'name' => 'New',
            'color' => 'success',
        ],
        [
            'id' => 'Back',
            'name' => 'Back',
            'color' => 'dark',
        ]
    ],
    'enviroments' => [
        [
            'id' => 'development',
            'name' => 'Development',
            'color' => 'secondary',
        ],
        [
            'id' => 'staging',
            'name' => 'Staging',
            'color' => 'primary',
        ],
        [
            'id' => 'production',
            'name' => 'Production',
            'color' => 'danger',
        ]
    ],
    'parseStatus' => [
        [
            'id' => true,
            'name' => __('laka_log.log-parsed'),
            'color' => 'success'
        ],
        [
            'id' => false,
            'name' => __('laka_log.log-not-parsed'),
            'color' => 'danger'
        ]
    ]
];
