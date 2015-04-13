<?php
class QueryFactory
{
    // ---
    private static $instance = null;
    private static $Querytypes = ["select", "update", "insert", "delete"];

    // ---

    private function __construct()
    {
    }

    public static function Build($type, $table = null)
    {
        $type = strtolower($type);
        if (!in_array($type, self::$Querytypes))
            return;

        $query = [];
        switch ($type) {
            case "insert":
                $query = self::instance()->insert($table);
                break;
            case "update":
                $query = self::instance()->update($table);
                break;
            case "delete":
                $query = self::instance()->delete($table);
                break;
            default:
            case "select":
                $query = self::instance()->select($table);
                break;
        }

        return new Query($query);
    }

    private function update($table)
    {
        return [new Update(), new Table($table), new UpdateSet(), new Where(), new Limit()];
    }

    private function delete($table)
    {
        return [new Delete(), new Table($table), new Where(), new Limit()];
    }

    private function insert($table)
    {
        return [new Insert(), new Table($table), new InsertSet()];
    }

    private function select($table)
    {
        return [new Select(), new Table($table), new Where(), new Limit()];
    }

    private static function instance()
    {
        if (!isset(self::$instance) || self::$instance == null) {
            //echo"\n================= creating (". __CLASS__ .") =================\n";
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
}