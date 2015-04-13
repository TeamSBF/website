<?php
/*
 * The singleton QueryFactory
 */
class QueryFactory
{
    // ---
    /*
     * A reference to the singleton instance
     *
     * @var QueryFactory
     */
    private static $instance = null;
    /*
     * The types of queries that are allowed
     *
     * @var array
     */
    private static $Querytypes = ["select", "update", "insert", "delete"];

    // ---

    /*
     * Private constructor to prevent outside initialization
     */
    private function __construct()
    {
    }

    /*
     * The method that build and returns the requested query type
     *
     * @param string $type The type of query to return
     * @param string $table (Optional) The table name to associate the query with. This can be specified later.
     * @return Query The requested query object
     */
    public static function Build($type, $table = null)
    {
        // Lower case to make things easier
        $type = strtolower($type);
        // If the given $type is not a valid query type, return null
        if (!in_array($type, self::$Querytypes))
            return null;

        // Initialize the query structure
        $structure = [];
        // Get the structure associated with the given $type
        // ToDo: look for a better way to implement this.
        switch ($type) {
            case "insert":
                $structure = self::instance()->insert($table);
                break;
            case "update":
                $structure = self::instance()->update($table);
                break;
            case "delete":
                $structure = self::instance()->delete($table);
                break;
            default:
            case "select":
                $structure = self::instance()->select($table);
                break;
        }

        return new Query($structure);
    }

    /*
     * The next 4 private methods return their respective query structures
     */
    private function update($table)
    {
        // Update requires an update, table, updateSet (this extends Set), where, and limit
        return [new Update(), new Table($table), new UpdateSet(), new Where(), new Limit()];
    }

    private function delete($table)
    {
        // Delete requires a delete, table, where, and limit
        return [new Delete(), new Table($table), new Where(), new Limit()];
    }

    private function insert($table)
    {
        // Insert requires an insert, table, and insertSet (this extends Set)
        return [new Insert(), new Table($table), new InsertSet()];
    }

    private function select($table)
    {
        // Select requires a select, table, where, and limit
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