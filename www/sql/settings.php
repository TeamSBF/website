<?php
$name = "settings";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('name')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('value')->MakeVarchar(100);// +1 day or something like that
$table->AddColumn('enabled')->MakeBool()->DefaultValue('false');

$population = array();
$population[] = QueryFactory::Build("insert")->Into($name)->Set( ["name", "forgotpassword"], ["value", "+ 50 seconds"], ["enabled",1] );
return[$table,$population];
