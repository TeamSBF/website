<?php
class QueryTests
{
    private function __construct()
    {

    }

    public static function All()
    {
        $results = [];
        $results["Insert"] = self::Insert();
        $results["Select"] = self::Select();
        $results["Update"] = self::Update();
        $results["Delete"] = self::Delete();

        return $results;
    }

    public static function Insert()
    {
        $results = [];
        $test = QueryFactory::Build("insert");
        $test->Into("users")->Set(["id", "1"], ["email", "asd"], ["password", "pass"], ["salt", "blah"], ["created", "UNIX_TIMESTAMP()"]);
        self::testing("Insert");

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, true, 1, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, false, 0, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        return $results;
    }

    public static function Select()
    {
        $results = [];
        $test = QueryFactory::Build("select");
        $test->Select("id","email","password")->From("users")->Where(["email","=","asd"]);
        self::testing("Insert");

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, true, 1, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        $test->Where(["email","=","doesnotexist"]);
        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, false, 0, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        return $results;
    }

    public static function Update()
    {
        $results = [];
        $test = QueryFactory::Build("Update");
        $test->Table("users")->Set(["created","UNIX_TIMESTAMP()"],["email","asd"],["password","asd"])->Where(["email","=","asd"])->Limit();
        self::testing("Update");

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, true, 1, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        $test->Where(["email","=","doesnotexist"]);
        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, false, 0, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        return $results;
    }

    public static function Delete()
    {
        $results = [];
        $test = QueryFactory::Build("delete");
        $test->From("users")->Where(["id","=","1","and"],["email","=","asd"])->Limit();
        self::testing("Delete");

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, true, 1, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        $qinfo = DatabaseManager::Query($test);
        self::testQuery($test, false, 0, $qinfo->RowCount());
        $results[count($results)] = $qinfo;

        return $results;
    }

    private static function testQuery($query, $type, $expected, $got)
    {
        self::results($type, $expected, $got);
        self::query($query->Query(true)[0]);
    }

    private static function testing($test)
    {
        echo "\n\n========================================================================================== $test Query Tests ==========================================================================================\n";
    }

    private static function query($testQuery)
    {
        echo "\nQuery Tested: " . $testQuery . "\n\n";
    }

    private static function results($type, $expected, $found)
    {
        $disp = "++++ ";
        if ($type)
            $disp .= "Success Test: ";
        else
            $disp .= "Fail Test:    ";

        if ($expected === $found)
            $disp .= "Passed";
        else
            $disp .= "Failed";

        echo $disp . " ++++";

    }
}