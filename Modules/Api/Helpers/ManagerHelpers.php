<?php

namespace Modules\Api\Helpers;

class ManagerHelpers
{
    public static function make($serverInfo)
    {
        $lstSrvInfo = static::parseServerInfo($serverInfo);
        $type = data_get($lstSrvInfo, 'server_type');
        if (blank($type)) return optional();
        $className = __NAMESPACE__.'\\'.ucfirst($type).'Helpers';
        return new $className($lstSrvInfo);
    }

    protected static function parseServerInfo($serverInfo)
    {
        return is_array($serverInfo) ? $serverInfo : json_decode($serverInfo, true);
    }
}
