<?php
require_once"config.php";
//require_once"Managers/DatabaseManager.php";
//require_once"QueryBuilder.php";
//require_once"cron/DatabaseMigration.php";

//DatabaseMigration::Migrate();

require_once"QueryFactory.php";

$conn = null;
$host = "localhost";
$dbname = "sbf_database";
$user = "root";
$pass = "root";
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}



function tableExists($conn, $tableName)
{
    try {
        $res = $conn->query("SELECT 1 FROM `$tableName` LIMIT 1");
    } catch (Exception $e) {
        return false;
    }

    return $res !== false;
}


$tableName = "users";
if(!tableExists($conn, $tableName))
{
    $user = include("sql/" . $tableName . ".php");
    echo $user->Query();
}
else echo"table does exist. do nothing.";