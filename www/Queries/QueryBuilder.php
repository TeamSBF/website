<?php
class QueryBuilder
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
            default:
            case "select":
                $query = self::instance()->select($table);
                break;
        }

        return new Query($query);
    }

    private function select($table = null)
    {
        $reqs = ["table" => $table];
        $pieces = [new Select(), new Table(), new Where(), new Limit()];//, "where", "limit"];

        $reqs["pieces"] = $pieces;
        return $reqs;
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