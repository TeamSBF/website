
<?php
$name = "old_users";
$table = new CreateTable($name);
$table->AddColumn('id')->MakeInt()->AddKey('unique');
$table->AddColumn('email')->MakeVarChar(100);

$population = array();
return [$table, $population];