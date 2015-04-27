<?php
$name = "groups";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('name')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('level')->MakeInt()->DefaultValue('1');


$population = array();

return [$table, $population];