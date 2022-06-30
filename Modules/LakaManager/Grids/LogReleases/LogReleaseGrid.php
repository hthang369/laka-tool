<?php

namespace Modules\LakaManager\Grids\LogReleases;

use App\Models\Users\User;
use Modules\Common\Grids\BaseGrid;

class LogReleaseGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'LogRelease';

    protected $actionColumnOptions = [
        'visible' => false,
    ];

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'user_id',
                'label' => 'User name',
                'lookup' => [
                    'dataSource' => resolve(User::class)->all(),
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
            ],
            [
                'key' => 'server_deploy',
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
                'label' => 'Action',
                'sortable' => false,
                'dataType' => 'buttons',
                'cell' => null,
            ]
        ];
    }

    protected function visibleCreate()
    {
        return false;
    }

    protected function getRefreshUrl()
    {
        return route($this->getSectionCode().'.log-release');
    }
}
