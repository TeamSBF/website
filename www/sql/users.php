<?php

$table = new CreateTable("users");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('password')->MakeVarChar(100);
$table->AddColumn('created')->MakeInt();
$table->AddColumn('activated')->MakeBool()->DefaultValue('false');

return $table;