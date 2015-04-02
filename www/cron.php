<?php
require_once"config.php";
//require_once"QueryBuilder.php";
//require_once"cron/DatabaseMigration.php";
require_once "Queries/QueryInfo.php";
require_once "Queries/QueryFactory.php";
require_once "Managers/DatabaseManager.php";
require_once "Queries/CreateTableQuery.php";

$tableName = "users";
if(!DatabaseManager::TableExists($tableName)) {
    $user = include("sql/" . $tableName . ".php");
    try {

        echo"<pre>";
		print_r(DatabaseManager::Query($user));
		echo"</pre>";
        echo "Added table '$tableName'<br>";
    } catch (PDOException $e) {
        echo "Adding table '$tableName' failed: " . $e->getMessage();
    }
}
else echo"table exists. do nothing.";