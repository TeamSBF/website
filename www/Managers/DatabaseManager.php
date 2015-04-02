<?php
class DatabaseManager
{
    // ---
    private static $instance = null;
    // ---
	
    private $conn = null;

    private function __construct()
    {
        $host = "localhost";
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
        $res = null;
        if($query instanceof CreateTableQuery)
        {
            $stmt = self::Instance()->conn->prepare($query->Query());
            $res = new QueryInfo($stmt->execute());
        }

        return $res;
    }
	
	public static function TableExists($tableName)
	{
		try{
			$res = self::Instance()->conn->query("SELECT 1 FROM `$tableName` LIMIT 1");
		} catch(Exception $e) {
			return false;
		}
		
		return $res !== false;
	}

    public static function Instance()
    {
        if (!isset($instance) || $instance == null) {
            $c = __CLASS__;
            $instance = new $c;
        }

        return $instance;
    }
}