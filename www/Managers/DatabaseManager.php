<?php
/**
 * The DatabaseManager Singleton is the only access point to the database in which query objects must be used
 */
class DatabaseManager extends Singleton
{
    // ---
    /**
     * The number of tries to attempt a given query
     *
     * @var int = 3
     */
    private static $tries = 3;
    // ---

    /**
     * The database connection string
     *
     * @var PDO
     */
    private $conn = null;

    /**
     * Private constructor to help ensure the singleton pattern
     */
    protected function __construct()
    {
        // connect to the database or throw an error if it can't
        $host = "127.0.0.1";
        $dbname = "sbf_database";
        $user = "root";
        $pass = "root";
        try {
            $this->conn = new PDO("mysql:dbname=$dbname;host:$host", $user, $pass);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }

    /**
     * Takes a query object of CreateTable or IQuery types and tries to execute it,
     * returning a QueryInfo object.
     *
     * @param $query An object that represents the query object. Either Query or CreateTable
     * @return QueryInfo A QueryInfo object that gives access to the query results, including any errors
     * @throws Exception
     */
    public static function Query($query)
    {
        $ret = "";
        $stmt = "";
        try {
            $instance = self::instance();
            // Determine which kind of object we're dealing with
            if ($query instanceof CreateTable) {
                $stmt = $instance->conn->prepare($query->Query());
            } else if ($query instanceof IQuery) {
                $stmt = $instance->parseIntoPrepared($query->Query());
            }

            // If neither of the above condtions is met, $stmt will be "" but needs to be
            // a PDOStatement so throw a new exception stating this
            if(!($stmt instanceof PDOStatement))
                throw new Exception("Fatal Error: no statement found");


            $errors = "";
            // Try to execute the given query 3 times
            for ($i = 0; !$stmt->execute() && $i < self::$tries; $i++) {
                // Gather the error information
                $err = $stmt->errorInfo()[2];
                // Concatenate the error info together
                $errors .= "Failed to process the query: " . $err . "\n";

                // If the error is data related, not database related, break out as
                // there is nothing that can be done to solve that problem
                if (is_numeric(strpos(strtolower($err),"duplicate")))
                    break;

                // Toss the query and the error info off to the MigrationManager to see if it can't
                // find a fix to the problem
                MigrationManager::instance()->HandleError($query, $stmt->errorInfo());
            }
            // Set the return value to a new Query Info object
            $ret = new QueryInfo($stmt, $errors);

        } catch (PDOException $e) {
            echo "Error occured executing query '$query->Query()': " . $e->getMessage();
        }

        return $ret;
    }

    /**
     * Returns a description of the provided table. Only used by the MigrationManager.
     * This needs to be restricted to only be accessible by the MigrationManager.
     *
     * @param string $table The name of the table to get the description of
     * @return PDOStatement The PDOStatement associated with the table description
     */
    public function Table($table)
    {
        $stmt = $this->conn->prepare("DESCRIBE `" . $table . "`");
        $stmt->execute();
        return $stmt;
    }

    /**
     * Parses a given query into a prepared statement getting it ready for execution
     *
     * @param array $query An array that contains the query and CVPairs that need to be bound
     * @return PDOStatement The finalized prepared statement that's ready to be executed
     */
    private function parseIntoPrepared($query)
    {
        // Grab the string query
        $q = $query[0];
        // Grab the cvpairs to be bound
        $cvpair = $query[1];
        // Create the prepared statement with the given query
        $stmt = $this->conn->prepare($q);
        // Bind all the columns with their associated values
        for ($i = 0; $i < count($cvpair); $i++)
            $stmt->bindValue(":" . $cvpair[$i]->Column(), $cvpair[$i]->Value());

        return $stmt;
    }

    /**
     * Is used to determine if a given table exists
     *
     * @param string $tableName The name of the table to check for
     * @return boolean True if the table exists, false if not
     */
    public function TableExists($tableName)
    {
        try {
            $res = $this->conn->query("SELECT 1 FROM `$tableName` LIMIT 1");
        } catch (Exception $e) {
            return false;
        }

        return $res !== false;
    }
}