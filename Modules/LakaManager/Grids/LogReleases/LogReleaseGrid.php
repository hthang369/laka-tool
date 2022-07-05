<?php

namespace Modules\LakaManager\Grids\LogReleases;

use App\Models\Users\User;
use Laka\Core\Facades\Common;
use Modules\Common\Grids\BaseGrid;
use Modules\LakaManager\Entities\Deploys\DeployModel;

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
        $dataSourceServer = config('lakamanager.serverList');
        $dataSourceType = config('lakamanager.releaseTypes');
        $dataSourceEnv = config('lakamanager.enviroments');
        $serverListModel = DeployModel::pluck('id', 'name');
        array_walk($dataSourceServer, function(&$item) use($serverListModel) {
            if ($serverListModel->has($item['id'])) {
                $id = $serverListModel->get($item['id']);
                data_set($item, 'id', $id);
            }
            return $item;
        });
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
                'key' => 'deploy_server_id',
                'label' => 'Server Deploy',
                'filtering' => true,
                'lookup' => [
                    'dataSource' => $dataSourceServer,
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
                'formatter' => function($value, $key, $item) use($dataSourceServer) {
                    return $this->formatterDisplayText($dataSourceServer, $value);
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
                'lookup' => [
                    'dataSource' => $dataSourceType,
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
                'formatter' => function($value, $key, $item) use($dataSourceType) {
                    return $this->formatterDisplayText($dataSourceType, $value);
                }
            ],
            [
                'key' => 'environment',
                'filtering' => true,
                'lookup' => [
                    'dataSource' => $dataSourceEnv,
                    'displayExpr' => 'name',
                    'valueExpr' => 'id'
                ],
                'formatter' => function($value, $key, $item) use($dataSourceEnv) {
                    return $this->formatterDisplayText($dataSourceEnv, $value);
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

    private function formatterDisplayText($dataSource, $value)
    {
        $data = head(array_where($dataSource, function($item, $key) use($value) {
            return str_is($item['id'], $value);
        }));
        return Common::formatBadge(data_get($data, 'name'), data_get($data, 'color'));
    }
}
