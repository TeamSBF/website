<?php

$table = QueryFactory::CreateTable("users");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('password')->MakeVarChar();
$table->AddColumn('created')->MakeInt();
$table->AddColumn('activated')->MakeBool()->DefaultValue('false');

return $table;