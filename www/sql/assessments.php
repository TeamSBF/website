<?php
// -2 is default of user doesn't want
$table = new CreateTable("assessments");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('userid')->MakeInt();
$table->AddColumn('TestNumber')->MakeInt()->DefaultValue(1);
$table->AddColumn('DateCompleted')->MakeInt()->DefaultValue(0);
$table->AddColumn('Chairstand')->MakeInt()->DefaultValue(-2);
$table->AddColumn('ArmCurl')->MakeInt()->DefaultValue(-2);
$table->AddColumn('StepTest')->MakeInt()->DefaultValue(-2);
$table->AddColumn('FootUpAndGo')->MakeFloat()->DefaultValue(-2);
$table->AddColumn('leftunilateralbalancetest')->MakeFloat()->DefaultValue(-2);
$table->AddColumn('rightunilateralbalancetest')->MakeFloat()->DefaultValue(-2);
$table->AddColumn('FunctionalReach')->MakeInt()->DefaultValue(-2);
$table->AddColumn('reminded')->MakeBool->DefaultValue('false');

return [$table,[]];
?>