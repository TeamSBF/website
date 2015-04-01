<?php
class DatabaseManager
{
    // ---
    private static $instance = null;
    // ---

    private $conn = null;

    private function __construct()
    {
        $dsn = "mysql:dbname=sbf_database;host:localhost";
        $user = "root";
        $pass = "root";
        try {
            $conn = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }

    public function test()
    {
        echo "test db";
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