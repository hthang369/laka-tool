<?php

namespace App\Presenters\LogReleases;

use Laka\Core\Grids\BaseGridPresenter;

class LogReleaseGridPresenter extends BaseGridPresenter
{
    protected $actionColumnOptions = [
        'visible' => false
    ];

    protected function setColumns()
    {

        return [
            'user_name',
            [
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
            'redmine_id',
            'version',
            [
                'key' => 'release_type',
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

        ];
    }
}
