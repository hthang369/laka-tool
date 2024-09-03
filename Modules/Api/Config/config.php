<?php

return [
    'name' => 'Api',
    'source_url' => env('SOURCE_URL'),
    'list_type' => [
        'sqlsrv' => 'Sql Server',
        'mysql' => 'MySql',
        'mariadb' => 'MariaDB',
    ],
    'list_sv' => [
        'sqlsrv' => [],
        'mysql' => [
            'from' => [
                [
                    'server_name' => 'local mac',
                    'host_name' => '127.0.0.1',
                    'user_name' => 'root',
                    'password' => '123456'
                ]
            ],
            'to' => [

            ]
        ]
    ],
    'list_func' => [
        'COL_REMANE' => [
            'sqlsrv' => "EXEC sp_rename '@TableName@.@OldName@', '@NewName@', 'COLUMN';",
            'mysql' => 'ALTER TABLE @TableName@ CHANGE COLUMN @OldName@ @NewName@;',
            'mariadb' => 'ALTER TABLE @TableName@ CHANGE COLUMN @OldName@ @NewName@;',
        ],
        'COL_REPLACENAME' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'COL_ADD' => [
            'sqlsrv' => 'ALTER TABLE @TableName@ ADD @Option@;',
            'mysql' => 'ALTER TABLE @TableName@ ADD @Option@;',
            'mariadb' => 'ALTER TABLE @TableName@ ADD @Option@;',
        ],
        'COL_ALTER' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'COL_DROP' => [
            'sqlsrv' => 'ALTER TABLE @TableName@ DROP COLUMN @ColumnName@;',
            'mysql' => 'ALTER TABLE @TableName@ DROP COLUMN @ColumnName@;',
            'mariadb' => 'ALTER TABLE @TableName@ DROP COLUMN @ColumnName@;',
        ],
        'COL_RESET_COLLATE' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'COL_CHANGE_COLLATE' => [
            'sqlsrv' => 'ALTER TABLE @TableName@ ALTER COLUMN @ColumnOption@ COLLATE @NeưCollate@;',
            'mysql' => 'ALTER TABLE @TableName@ MODIFY COLUMN @ColumnOption@ COLLATE @NeưCollate@;',
            'mariadb' => 'ALTER TABLE @TableName@ MODIFY COLUMN @ColumnOption@ COLLATE @NeưCollate@;',
        ],
        'DEF_ADD' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DEF_DROP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'IDX_ADD' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'IDX_DROP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'PK_ADD' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'PK_DROP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'FK_ADD' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'FK_DROP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'TABLE_CREATE' => [
            'sqlsrv' => 'CREATE TABLE @TableName@ (@Options@);',
            'mysql' => 'CREATE TABLE @TableName@ (@Options@);',
            'mariadb' => 'CREATE TABLE @TableName@ (@Options@);',
        ],
        'TABLE_RENAME' => [
            'sqlsrv' => "EXEC sp_rename '@OldName@', '@NewName@';",
            'mysql' => 'RENAME TABLE @OldName@ TO @NewName@;',
            'mariadb' => 'RENAME TABLE @OldName@ TO @NewName@;',
        ],
        'TABLE_DROP' => [
            'sqlsrv' => 'DROP TABLE @TableName@;',
            'mysql' => 'DROP TABLE @TableName@;',
            'mariadb' => 'DROP TABLE @TableName@;',
        ],
        'TABLE_ZAP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'TABLE_READONLY' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'IS_FILE' => '',
        'RESEED' => '',
        'DB_CREATE' => [
            'sqlsrv' => 'CREATE DATABASE @DBName@',
            'mysql' => 'CREATE DATABASE @DBName@ CHARACTER SET @charset@ COLLATE @collation@;',
            'mariadb' => 'CREATE DATABASE @DBName@ CHARACTER SET @charset@ COLLATE @collation@;',
        ],
        'DB_DROP' => [
            'sqlsrv' => 'DROP DATABASE @DBName@',
            'mysql' => 'DROP DATABASE @DBName@;',
            'mariadb' => 'DROP DATABASE @DBName@;',
        ],
        'DB_BACKUP' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_SHRINK' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_COPY' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_RESTORE' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_RESTART' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_ROLLBACK' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_ATTACH' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_DETACH' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'DB_ALTER' => [
            'sqlsrv' => '',
            'mysql' => '',
            'mariadb' => '',
        ],
        'EXEC_SCRIPT' => '',
        'TIMERSCRIPT' => '',
        'CLIPBOARD_REMOVE_DUPLICATE' => [
            'func' => ''
        ],
        'CLIPBOARD_REPLACE' => [
            'func' => ''
        ],
        'CLIPBOARD_CHANGE' => [
            'func' => ''
        ],
        'CLIPBOARD_LINE_SUBSTRING' => [
            'func' => ''
        ],
        'CLIPBOARD_CONVERT_FONT' => [
            'func' => ''
        ],
        'CLIPBOARD_BROWSE' => [
            'func' => 'clipboardBrowse'
        ],
        'CLIPBOARD_MAXLEN' => '',
        'CLIPBOARD_SQL_FORMAT' => '',
        'CLIPBOARD_MKDIR' => '',
    ],
    'list_util' => [
        'CHANGE_DB_LARAVEL' => [
            'func' => 'ChangeDbLaravel',
            'script' => ''
        ],
        'LARAVEL_CLEAR_CACHE' => [
            'func' => 'CmdLaravelClearCache',
            'script' => 'php artisan cache:clear',
        ],
        'LARAVEL_CLEAR_CONFIG' => [
            'func' => 'CmdLaravelClearConfig',
            'script' => 'php artisan config:clear',
        ],
        'LARAVEL_PERMISSION_FRESH' => [
            'func' => 'CmdLaravelPermissionFresh',
            'script' => 'php artisan permission:fresh',
        ],
        'LARAVEL_CONFIG_CACHE' => [
            'func' => 'CmdLaravelConfigCache',
            'script' => 'php artisan config:cache',
        ],
        'LARAVEL_MIGRATE' => [
            'func' => 'CmdLaravelMigrate',
            'script' => 'php artisan migrate',
        ],
        'LARAVEL_DUMP_AUTOLOAD' => [
            'func' => 'CmdLaravelDumpAutoload',
            'script' => 'php artisan dump:autoload',
        ],
        'LARAVEL_DB_SEED' => [
            'func' => 'CmdLaravelDbSeed',
            'script' => 'php artisan db:seed @Options@',
            'params' => [
                '@Options@' => ''
            ]
        ],
        'LARAVEL_LANG_SEEDER' => [
            'func' => 'CmdLaravelLangSeeder',
            'script' => 'php artisan db:seed --class=LangSeeder',
        ],
        'LARAVEL_MODULE_SEEDER' => [
            'func' => 'CmdLaravelModuleSeeder',
            'script' => 'php artisan module:seed @ModuleName@ @Options@',
            'params' => [
                '@ModuleName@' => '',
                '@Options@' => ''
            ]
        ],
        'LARAVEL_MODULE_MAKE' => [
            'func' => 'CmdLaravelModuleMake',
            'script' => 'php artisan module:make @ModuleName@',
            'params' => [
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_COMMAND' => [
            'func' => 'CmdLaravelModuleMakeCommand',
            'script' => 'php artisan module:make-command @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_MIGRATION' => [
            'func' => 'CmdLaravelModuleMakeMigration',
            'script' => 'php artisan module:make-migration @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_SEED' => [
            'func' => 'CmdLaravelModuleMakeSeed',
            'script' => 'php artisan module:make-seed @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_CONTROLLER' => [
            'func' => 'CmdLaravelModuleMakeController',
            'script' => 'php artisan module:make-controller @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_MODEL' => [
            'func' => 'CmdLaravelModuleMakeModel',
            'script' => 'php artisan module:make-model @CommandName@ @ModuleName@ @Options@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
                '@Options@' => ''
            ]
        ],
        'LARAVEL_MODULE_MAKE_PROVIDER' => [
            'func' => 'CmdLaravelModuleMakeProvider',
            'script' => 'php artisan module:make-provider @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_MIDDLEWARE' => [
            'func' => 'CmdLaravelModuleMakeMiddleware',
            'script' => 'php artisan module:make-middleware @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_MAIL' => [
            'func' => 'CmdLaravelModuleMakeMail',
            'script' => 'php artisan module:make-mail @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_NOTIFICATION' => [
            'func' => 'CmdLaravelModuleMakeNotification',
            'script' => 'php artisan module:make-notification @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_LISTENER' => [
            'func' => 'CmdLaravelModuleMakeListener',
            'script' => 'php artisan module:make-listener @CommandName@ @ModuleName@ @Options@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
                '@Options@' => ''
            ]
        ],
        'LARAVEL_MODULE_MAKE_REQUEST' => [
            'func' => 'CmdLaravelModuleMakeRequest',
            'script' => 'php artisan module:make-request @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_EVENT' => [
            'func' => 'CmdLaravelModuleMakeEvent',
            'script' => 'php artisan module:make-event @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_JOB' => [
            'func' => 'CmdLaravelModuleMakeJob',
            'script' => 'php artisan module:make-job @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_FACTORY' => [
            'func' => 'CmdLaravelModuleMakeFactory',
            'script' => 'php artisan module:make-factory @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_POLICY' => [
            'func' => 'CmdLaravelModuleMakePolicy',
            'script' => 'php artisan module:make-policy @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_RULE' => [
            'func' => 'CmdLaravelModuleMakeRule',
            'script' => 'php artisan module:make-rule @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_RESOURCE' => [
            'func' => 'CmdLaravelModuleMakeResource',
            'script' => 'php artisan module:make-resource @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_MAKE_TEST' => [
            'func' => 'CmdLaravelModuleMakeTest',
            'script' => 'php artisan module:make-test @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_MODULE_ROUTE_PROVIDER' => [
            'func' => 'CmdLaravelModuleRouteProvider',
            'script' => 'php artisan module:route-provider @CommandName@ @ModuleName@',
            'params' => [
                '@CommandName@' => '',
                '@ModuleName@' => '',
            ]
        ],
        'LARAVEL_ROUTE_LIST' => [
            'func' => 'CmdLaravelRouteList',
            'script' => 'php artisan route:list --json',
        ],
        'GIT_BRANCH' => [
            'func' => '',
            'script' => 'git branch'
        ],
        'GIT_DELETE_BRANCH' => [
            'script' => 'git branch --delete @branchName@',
            'params' => [
                '@branchName@' => ''
            ]
        ]
    ]
];
