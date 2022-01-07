<?php

return [
    'time_expired_code' => 300,
    'api_token'         => env('API_TOKEN','7a79f1243f25a3bf9c66043aceebc6eb'),
    'api_address'       => env('API_ADDRESS', 'http://172.16.2.8:91'),
    'pagination' => [
        'items_per_page' => 100
    ],
    'cache_expire' => 10,
    'deploy' => [
        'list_environment' => [
            'development' => [
                'api' => ['http://172.16.2.8:8000'],
                'backend' => ['http://172.16.2.8:8000'],
                'frontend' => ['http://172.16.2.8:8000'],
                'socket' => ['http://172.16.2.8:8000'],
            ],
            'staging' => [
                'api' => ['http://172.16.3.36.:8000'],
                'backend' => ['http://172.16.3.36.:8000'],
                'frontend' =>['http://172.16.3.36.:8000'],
                'socket' => ['http://172.16.3.36.:8000'],
            ],
            'production' => [
                'api' => ['http://laka.lampart-vn.com:8000'],
                'backend' => ['http://laka.lampart-vn.com:8000'],
                'frontend' => ['http://laka.lampart-vn.com:8000'],
                'socket' => ['http://laka.lampart-vn.com:8000'],
            ],
        ]
    ]
];
