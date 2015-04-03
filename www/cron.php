<?php
require_once"config.php";
require_once "Queries/QueryInfo.php";
require_once "Queries/QueryFactory.php";
require_once "Managers/DatabaseManager.php";
require_once "Queries/CreateTableQuery.php";
require_once "Queries/SelectQuery.php";

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
//else echo"table exists. do nothing.";

$select = new SelectQuery();
$select->Select("id")->From("users")->WhereColumns("id")->WhereOperators("=")->WhereValues("1");
$qinfo = DatabaseManager::Query($select);
echo"<pre>\nResults from ".$select->Query()[0]."\n";
print_r($qinfo->Result());
echo"</pre>";
