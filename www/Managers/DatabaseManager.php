<?php
class DatabaseManager
{
    // ---
    private static $instance = null;
    // ---

    private $conn = null;

    private function __construct()
    {
        //echo"\n================= connecting =================\n";
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

    public static function Query($query)
    {
        $ret = "";
        try {
            if ($query instanceof CreateTableQuery) {
                $stmt = self::instance()->conn->prepare($query->Query());
            } else if ($query instanceof IQuery) {
                $stmt = self::instance()->parseIntoPrepared($query->Query());
            }

            //$stmt->execute();
            //return new QueryInfo($stmt);
            //*
            if ($stmt->execute()) {
                $ret = new QueryInfo($stmt);

            } else {
                MigrationManager::HandleError($query, $stmt->errorInfo());
                $ret = self::Query($query);
            }
            //*/
        } catch (PDOException $e) {
            echo "Error occured executing query '$query->Query()': " . $e->getMessage();
        }

        return $ret;
    }

    public static function Table($table)
    {
        $stmt = self::instance()->conn->prepare("DESCRIBE `" . $table . "`");
        $stmt->execute();
        return $stmt;
    }

    private function parseIntoPrepared($query)
    {
        $q = $query[0];
        $cvpair = $query[1];

        $stmt = self::instance()->conn->prepare($q);
        for ($i = 0; $i < count($cvpair); $i++)
            $stmt->bindValue(":" . $cvpair[$i]->Column(), $cvpair[$i]->Value());

        return $stmt;
    }

    public static function TableExists($tableName)
    {
        try {
            $res = self::instance()->conn->query("SELECT 1 FROM `$tableName` LIMIT 1");
        } catch (Exception $e) {
            return false;
        }

        return $res !== false;
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