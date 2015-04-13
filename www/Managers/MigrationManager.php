<?php
/*
 * The MigrationManager Singleton that is used to handle all database migration issues and errors
 */
class MigrationManager
{
    // ---
    /*
     * The singleton instance
     *
     * @var MigrationManager = null
     */
    private static $instance = null;

    // ---

    /*
     * Private constructor to help prevent outside initialization
     */
    private function __construct()
    {
    }

    /*
     * Determines the error and how to handle it
     *
     * @param mixed $query The Query or CreateTable object that failed to execute
     * @param int $errorInfo The error that occurred
     */
    public static function HandleError($query, $errorInfo)
    {
        $instance = self::instance();
        switch ($errorInfo[1]) {
            case 1054: // 1054: field does not exist
                $instance->checkTable($query->Table());
                break;
            case 1146: // 1146: table does not exist
                $instance->createTable($query->Table());
                break;
        }
    }

    /*
     * Checks the currently existing table against the provided SQL schema in its associated file
     *
     * @param string $table The name of the table to check
     */
    private function checkTable($table)
    {
        // Get the fields from the existing table
        $fields = DatabaseManager::Table($table)->fetchAll(PDO::FETCH_COLUMN);
        // Get the table schema from the table structure in the file
        $schema = $this->grabTableInfo($table);
        // Get the fields/columns from the schema - these will be used for comparison
        $columns = $schema->Columns();
        // Get the keys from the schema - used to determine if the key needs to be added
        $keys = $schema->Keys();

        $toAdd = [];
        // Compare the current table fields to the files fields
        for ($i = 0; $i < count($columns); $i++) {
            $add = true;
            // Get the current column name
            $colname = $columns[$i]['name'];
            // Check to see if the column name from the schema exists in the current table schema
            for ($j = 0; $j < count($fields); $j++) {
                // If the column does exist, skip it
                if ($colname == $fields[$j]) {
                    $add = false;
                    break;
                }
            }
            // If the column does not exist, add it to the list of columns that need to be re-added
            if($add)
                $toAdd[count($toAdd)] = $columns[$i];

        }

        // If there are any columns to be added, add them.
        // This check might be redundant as technically it should not get here unless there are columns missing.
        if(count($toAdd) > 0)
            $this->alterTable($table, $toAdd, $keys);
    }

    /*
     * Used to create the alter table query that will be used to repair a given table
     *
     * @param string $table The table to be altered
     * @param array $toAdd The columns that need to be added to $table
     * @param array $keys The keys associated with the columns to be added (if any)
     */
    private function alterTable($table, $toAdd, $keys)
    {
        // Create a new alter table query
        $alter = new AlterTable();
        // Set the table to alter to $table
        $alter->Table($table);
        // Add each field to the alter table query
        for ($i = 0; $i < count($toAdd); $i++)
            $alter->AddField($toAdd[$i]['name'], $toAdd[$i]['type'], $toAdd[$i]['value']);
        // Add the keys if needed
        $this->addKeys($alter, $keys);

        // Execute the alter query
        DatabaseManager::Query($alter);
    }

    /*
     * Adds keys to an alter table query
     *
     * @param AlterTable $alter The alert table query
     * @param array $keys The table keys to add
     */
    private function addKeys($alter, $keys)
    {
        // Get the fields out of the alter query
        $fields = $alter->Fields();
        // Add keys if any of the fields have associated keys
        for ($i = 0; $i < count($fields); $i++) {
            // Grab the name of the field
            $name = $fields[$i]->Name();
            // Make the column primary if the key is a primary key AND the associated name matches
            if (array_key_exists("primary", $keys) && $keys["primary"] == $name)
                $alter->AddKey("primary", $keys["primary"]);

            // If there are any unique keys
            if (array_key_exists("unique", $keys))
                // Add the unique keys as needed
                for ($j = 0; $j < count($keys["unique"]); $j++)
                    // If the name of the unique key matches, add the key
                    if ($keys["unique"][$j] == $name)
                        $alter->AddKey("unique", $keys["unique"][$j]);

            // If the column needs to be set to auto-increment
            if (array_key_exists("ai", $keys) && $keys["ai"] == $name)
                $alter->SetAutoIncrement($keys["ai"]);
        }
    }

    /*
     * Attempts to create the specified table
     *
     * @param string $table The name of the table
     */
    private function createTable($table)
    {
        try {
            // Gets the table information from the associated table file
            $schema = $this->grabTableInfo($table);
            // Executes the query to build the table
            DatabaseManager::Query($schema);
        } catch (PDOException $e) {
            echo "Adding table '$table' failed: " . $e->getMessage();
        }
    }

    /*
     * Returns the file associated table structure
     *
     * @param string $table The name of the table to retrieve
     */
    private function grabTableInfo($table)
    {
        return require("sql/" . $table . ".php");
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