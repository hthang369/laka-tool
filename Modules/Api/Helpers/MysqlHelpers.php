<?php

namespace Modules\Api\Helpers;

class MysqlHelpers extends BaseHelpers
{
    public function getListDatabase()
    {
        return $this->db->select('SHOW DATABASES WHERE `Database` NOT IN (?,?,?)', ['information_schema','performance_schema','mysql']);
    }

    public function getListTable()
    {
        $dbName = $this->db->getDatabaseName();
        return $this->db->table('information_schema.TABLES')
            ->where(['table_schema' => $dbName, 'table_type' => 'BASE TABLE'])
            ->get([
                'table_schema as table_schema',
                'table_name as table_name',
                'engine as engine',
                'table_rows as table_rows',
                'table_collation as table_collation'
            ]);
    }

    public function getDescribeTable($tableName)
    {
        $dbName = $this->db->getDatabaseName();
        return $this->db->select('DESCRIBE `?`.`?`', [$dbName, $tableName]);
    }

    public function getStrategyData(int $page, int $limt, array $filters = [])
    {
        $query = $this->db->table('strategy')->forPage($page, $limt);
        foreach($filters as $key => $val) {
            if (is_array($val)) {
                $query->whereIn($key, $val);
            } else {
                $query->where($key, $val);
            }
        }
        return $query->get();
    }
}
