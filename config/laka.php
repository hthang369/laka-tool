<?php

return [
    'pagination' => [
        'onEachPage' => 1, // Số trang hiển thị 2 bên trang hiện tại
        'numberFirstPage' => 1, // Số trang đầu tiên cân hiển thị,
        'numberLastPage' => 1, // Số trang cuối cân hiển thị
        'perPage' => 20,
    ],
    'pager' => [
        'allowedPageSizes' => [10, 15, 20, 30, 50, 100],
        'showPageSizeSelector' => true,
        'showInfo' => true,
        'infoText' => 'table.show_result'
    ],
    'table' => [
        'sticky_header' => false
    ],
    'time_expired_code' => 300,
    'api_token'         => env('API_TOKEN','7a79f1243f25a3bf9c66043aceebc6eb'),
    'api_address'       => env('API_ADDRESS', 'http://172.16.2.8:91'),
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
    ],
    'repair-data' => [
        'command' => [
            'restore' => [
                'supervisorctl stop dbredis:*',
                'sudo rm /tmp/RediSearch/dump.rdb.old',
                'sudo mv /tmp/RediSearch/dump.rdb /tmp/RediSearch/dump.rdb.old',
                'sudo cp -p /mnt/:path/:filename /tmp/RediSearch',
                'sudo mv /tmp/RediSearch/:filename /tmp/RediSearch/dump.rdb',
                'supervisorctl start dbredis:*'
            ]
        ]
    ]
];
