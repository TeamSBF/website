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
        try {
            if ($query instanceof CreateTableQuery) {
                $stmt = self::Instance()->conn->prepare($query->Query());
            } else if ($query instanceof SelectQuery) {
                $q = $query->Query()[0];
                $cols = $query->Query()[1];
                $vals = $query->Query()[2];

                $stmt = self::Instance()->conn->prepare($q);
                for ($i = 0; $i < count($cols); $i++)
                    $stmt->bindParam(":" . $cols[$i], $vals[$i]);
            }

            $stmt->execute();

            return new QueryInfo($stmt);
        } catch (PDOException $e) {
            echo "Error occured executing query '$query->Query()': " . $e->getMessage();
        }

        return null;
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