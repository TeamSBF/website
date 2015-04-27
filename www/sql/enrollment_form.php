<?php

$table = new CreateTable("enrollment_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('userID')->MakeInt()->AddKey('unique');
$table->AddColumn('completed')->MakeBool()->DefaultValue('false');
$table->AddColumn('lastName')->MakeVarChar(50);
$table->AddColumn('firstName')->MakeVarChar(50);
$table->AddColumn('streetAddress')->MakeVarChar(150);
$table->AddColumn('city')->MakeVarChar(50);
$table->AddColumn('phone')->MakeVarChar(20);
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('dob')->MakeVarChar(11)->DefaultValue('false');
$table->AddColumn('gender')->MakeVarChar(7);
$table->AddColumn('healthHistory')->MakeVarChar(500)->DefaultValue('false');
$table->AddColumn('watchSbf')->MakeBool()->DefaultValue('false');
$table->AddColumn('HowManyTimesAWeek')->MakeInt()->DefaultValue(0);
$table->AddColumn('controlGroup')->MakeVarChar(4)->DefaultValue("No");
$table->AddColumn('experimentalGroup')->MakeVarChar(4)->DefaultValue("No");

return [$table,[]];