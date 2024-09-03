<?php

namespace Modules\Api\Helpers;

use Illuminate\Support\Facades\DB;
use Modules\Api\Entities\Tools\ServersModel;

abstract class BaseHelpers
{
    public $db;

    public function __construct($serverInfo)
    {
        $srvName = $this->initServerName($serverInfo);
        $this->db = DB::connection($srvName);
    }

    abstract public function getListDatabase();
    abstract public function getListTable();

    public function executeQuery($query)
    {
        $query = array_wrap($query);
        return $this->db->select(data_get($query, 0), data_get($query, 1, []));
    }

    public function initServerName($serverInfo)
    {
        $info = $this->parseServerInfo($serverInfo);
        extract($info);
        return $this->generateServerName($type, $server_type, $server_name, $database);
    }

    public function parseServerInfo($serverInfo)
    {
        return is_array($serverInfo) ? $serverInfo : json_decode($serverInfo, true);
    }

    protected function generateServerName($fromName, $serviceName, $serverName, $database = null)
    {
        $serverConfig = config("database.connections.{$serviceName}");
        $newConfig = ServersModel::whereHas('service', function($query) use($serviceName) {
            return $query->where('type', $serviceName);
        })->firstWhere('name', $serverName);
        list($hostName, $port) = explode(':', data_get($newConfig, 'host_name'));

        $svNewConfig = array_merge($serverConfig, [
            'host' => $hostName,
            'port' => $port,
            'username' => data_get($newConfig, 'user_name'),
            'password' => data_get($newConfig, 'password'),
            'database' => $database
        ]);
        $newName = str_slug($serverName, '_');
        config(["database.connections.{$newName}" => $svNewConfig]);

        return $newName;
    }
}
