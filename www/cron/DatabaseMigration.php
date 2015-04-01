<?php
class DatabaseMigration
{
    private static $instance = null;

    private $db = null;
    private $qb = null;
    private function __construct()
    {
        $this->db = DatabaseManager::Instance();
        $this->qb = QueryBuilder::Instance();
    }

    private function test()
    {
        $this->db->test();
    }

    public static function Migrate()
    {
        //self::Instance()->test();
        // grab the database manager instance, makes referencing it much easier
        // alternative: 'self::Instance()->db' every time
        $db = self::Instance()->db;
        $qb = self::Instance()->qb;


    }

    public static function Instance()
    {
        if(!isset($instance) || $instance == null)
        {
            $c = __CLASS__;
            $instance = new $c;
        }

        return $instance;
    }
}