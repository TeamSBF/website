<?php

$table = new CreateTableQuery("enrollment_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('lastName')->MakeVarChar(50);
$table->AddColumn('firstName')->MakeVarChar(50);
$table->AddColumn('streetAddress')->MakeVarChar(120);
$table->AddColumn('city')->MakeVarChar(50);
$table->AddColumn('phone')->MakeVarChar(20);
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('dob')->MakeVarChar(10)->DefaultValue('false');
$table->AddColumn('gender')->MakeBool()->DefaultValue('false');
$table->AddColumn('healthHistory')->MakeVarChar(500)->DefaultValue('false');
$table->AddColumn('watchSbf')->MakeBool()->DefaultValue('false');
$table->AddColumn('HowManyTimesAWeek')->MakeInt()->DefaultValue(0);
$table->AddColumn('controlGroup')->MakeBool()->DefaultValue('false');
$table->AddColumn('experimentalGroup')->MakeBool()->DefaultValue('false');

return $table;