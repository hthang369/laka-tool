<?php

namespace App\Presenters\LogReleases;

use App\Presenters\CoreGridPresenter;

class LogReleaseGridPresenter extends CoreGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false,
    ];

    protected function setColumns()
    {

        return [
            [
                'key' => 'user_name',
                'filtering' => true,
            ],
            [
                'key'=>'server_deploy',
                'label' => 'Server Deploy',
                'cell' => function ($item) {
                    $arrColorForServer = [
                        'primary' => 'api',
                        'secondary' => 'frontend',
                        'dark' => 'backend',
                        'success' => 'socket'
                    ];
                    $serverName = $item->deployServer->name;
                    $color = array_search($serverName, $arrColorForServer, true);
                    return '<span class="badge badge-' . $color . '">' . $serverName . '</span>';

                }
            ],
            [
                'key' => 'redmine_id',
                'filtering' => true,
            ], [
                'key' => 'version',
                'filtering' => true,
            ],
            [
                'key' => 'release_type',
                'filtering' => true,
                'cell' => function ($item) {
                    $arrColorForTypeRelease = [
                        'success' => 'New',
                        'dark' => 'Back',
                    ];
                    $releaseType = $item->release_type;
                    $color = array_search($releaseType, $arrColorForTypeRelease, true);

                    return '<span class="badge badge-' . $color . '">' . $releaseType . '</span>';
                }
            ],
            [
                'key' => 'environment',
                'filtering' => true,
                'cell' => function ($item) {
                    $arrColorForEnv = [
                        'secondary' => 'development',
                        'primary' => 'staging',
                        'danger' => 'production',
                    ];
                    $env = $item->environment;
                    $color = array_search($env, $arrColorForEnv, true);

                    return '<span class="badge badge-' . $color . '">' . $env . '</span>';
                }
            ],
            [
                'label'=>'Action',
                'sortable' => false,
                'dataType' => 'buttons',
                'cell' => null,
            ],
        ];
    }
}
