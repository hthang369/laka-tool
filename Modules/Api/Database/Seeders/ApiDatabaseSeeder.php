<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Api\Entities\Tools\ConfigsModel;
use Modules\Api\Entities\Tools\DirectoriesModel;
use Modules\Api\Entities\Tools\InstanceModel;
use Modules\Api\Entities\Tools\ServicesModel;
use Modules\Api\Repositories\ServersRepository;

class ApiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->runConfigData();
    }

    public function runConfigData()
    {
        DB::transaction(function() {
            ServicesModel::truncate();
            $data = [
                ['type' => 'sqlsrv', 'name' => 'Sql Server'],
                ['type' => 'mysql', 'name' => 'MySql'],
                ['type' => 'mariadb', 'name' => 'MariaDB'],
            ];
            ServicesModel::upsert($data, ['type'], ['name']);

            // ConfigsModel::truncate();
            // $dataConfig = [];
            // foreach(config('api.list_func') as $key => $value) {
            //     array_push($dataConfig, ['type' => 'func', 'key' => $key, 'value' => json_encode($value)]);
            // }
            // foreach(config('api.list_util') as $key => $value) {
            //     array_push($dataConfig, ['type' => 'util', 'key' => $key, 'value' => json_encode($value)]);
            // }
            // ConfigsModel::upsert($dataConfig, ['type', 'key'], ['value']);
            // $path = '/Applications/App/Projects';
            // $directory = new \DirectoryIterator($path);
            // $dataPath = [];
            // foreach($directory as $dir) {
            //     if ($dir->isDir() && !$dir->isDot()) {
            //         array_push($dataPath, ['path' => $dir->getRealpath()]);
            //     }
            // }
            // DirectoriesModel::upsert($dataPath, ['id'], ['path']);
            $data = resolve(ServersRepository::class)->getListService();
            $listData = [];
            foreach($data as $item) {
                array_push($listData, [
                    'name' => data_get($item, 'name'),
                    'status' => data_get($item, 'status'),
                    'user' => data_get($item, 'user'),
                    'path' => data_get($item, 'file')
                ]);
            }
            InstanceModel::upsert($listData, ['name'], ['status', 'user', 'path']);
        });
    }
}
