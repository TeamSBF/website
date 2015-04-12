<?php
class MigrationManager
{
    // ---
    private static $instance = null;

    // ---

    private function __construct()
    {
    }

    public static function HandleError($query, $errorInfo)
    {
        // 1054: field does not exist
        // 1146: table does not exist
        $instance = self::instance();
        switch ($errorInfo[1]) {
            case 1054:
                $instance->checkTable($query->Table());
                break;
            case 1146:
                //echo "table does not exist";
                $instance->createTable($query->Table());
                break;
        }
    }

    private function checkTable($table)
    {
        //echo "field does not exist\n";
        $fields = DatabaseManager::Table($table)->fetchAll(PDO::FETCH_COLUMN);
        //print_r($fields);
        $schema = $this->grabTableInfo($table);
        $columns = $schema->Columns();
        $keys = $schema->Keys();
        //print_r($columns);
        //print_r($keys);

        $toAdd = [];
        // compare the current table fields to the files fields
        for ($i = 0; $i < count($columns); $i++) {
            $add = true;
            $colname = $columns[$i]['name'];
            for ($j = 0; $j < count($fields); $j++) {
                if ($colname == $fields[$j]) {
                    $add = false;
                    break;
                }
            }
            if($add)
                $toAdd[count($toAdd)] = $columns[$i];

        }

        if(count($toAdd) > 0)
            $this->alterTable($table, $toAdd, $keys);
    }

    private function alterTable($table, $toAdd, $keys)
    {
        $alter = new AlterTable();
        $alter->Table($table);
        for ($i = 0; $i < count($toAdd); $i++)
            $alter->AddField($toAdd[$i]['name'], $toAdd[$i]['type'], $toAdd[$i]['value']);

        $this->addKeys($alter, $keys);

        //print_r($alter->Query());
        DatabaseManager::Query($alter);
    }

    private function addKeys($alter, $keys)
    {
        $fields = $alter->Fields();
        for ($i = 0; $i < count($fields); $i++) {
            $name = $fields[$i]->Name();
            if (array_key_exists("primary", $keys) && $keys["primary"] == $name)
                $alter->AddKey("primary", $keys["primary"]);

            if (array_key_exists("unique", $keys))
                for ($j = 0; $j < count($keys["unique"]); $j++)
                    if ($keys["unique"][$j] == $name)
                        $alter->AddKey("unique", $keys["unique"][$j]);

            if (array_key_exists("ai", $keys) && $keys["ai"] == $name)
                $alter->SetAutoIncrement($keys["ai"]);
        }
    }

    private function createTable($table)
    {
        try {
            $schema = $this->grabTableInfo($table);
            //printr($schema->Query());

            //print_r(DatabaseManager::Query($user));
            DatabaseManager::Query($schema);
            //echo "Added table '$table'<br>";
        } catch (PDOException $e) {
            echo "Adding table '$table' failed: " . $e->getMessage();
        }
    }

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