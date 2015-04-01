<?php

class QueryFactory
{
    // ---
    private static $instance = null;
    // ---

    private $db = null;

    private function __construct()
    {
        //$this->db = DatabaseManager::Instance();
    }

    public static function CreateTable($tableName)
    {
        return self::instance()->query("table", $tableName);
    }

    private function query($type, $name)
    {
        $query = null;
        switch ($type) {
            case"table":
                $query = new TableQuery($name);
                break;
        }

        return $query;
    }

    private static function instance()
    {
        if (!isset($instance) || $instance == null) {
            $c = __CLASS__;
            $instance = new $c;
        }

        return $instance;
    }
}