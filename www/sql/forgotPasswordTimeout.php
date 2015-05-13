<?php
$name = "forgotPasswordTimeout";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('creationTime')->MakeVarChar(100);
$table->AddColumn('hash')->MakeVarChar(100)->AddKey('unique');

$population = array();
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["id", "0"], ["creationTime", "0"], ["hash", "0"]);
return [$table,$population];