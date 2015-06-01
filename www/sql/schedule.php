<?php
$name = "schedule";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('name')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('frequency')->MakeVarChar(100);
$table->AddColumn('lastRun')->MakeInt();

$population = array();
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name", "manageUsers.php"], ["frequency", "+1 minute"], ["lastRun", "UNIX_TIMESTAMP()"]);
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name", "test.php"], ["frequency", "+3 months"], ["lastRun", "UNIX_TIMESTAMP()"]);
//$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name", "activationTimer.php"], ["frequency", "+12 hours"], ["lastRun", "UNIX_TIMESTAMP()"]);
return [$table, $population];