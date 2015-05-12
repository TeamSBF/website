<?php
$name = "old_users";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
//$table->AddColumn('password')->MakeVarChar(100);
//$table->AddColumn('pLevel')->MakeInt()->DefaultValue('1');
//$table->AddColumn('created')->MakeInt();
//$table->AddColumn('activated')->MakeBool()->DefaultValue('false');

$population = array();
return [$table, $population];