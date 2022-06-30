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
                'sudo rm -f :redis_folder/dump.rdb.old',
                'sudo mv :redis_folder/dump.rdb :redis_folder/dump.rdb.old',
                'sudo cp -p :rootDir/:path/:filename :redis_folder',
                'sudo mv :redis_folder/:filename :redis_folder/dump.rdb',
                'supervisorctl start dbredis:*'
            ]
        ]
    ],
    'views' => [
        'index'     => '%s.list',
        'create'    => '%s.modify_modal',
        'edit'      => '%s.modify_modal',
        'show'      => '%s.modify_modal'
    ],
];
