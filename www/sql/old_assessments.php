<?php
// -2 is default of user doesn't want
$table = new CreateTable("old_assessments");
$table->AddColumn('id')->MakeInt();
$table->AddColumn('userid')->MakeInt();
$table->AddColumn('TestNumber')->MakeInt()->DefaultValue(1);
$table->AddColumn('DateCompleted')->MakeInt()->DefaultValue(0);
$table->AddColumn('Chairstand')->MakeInt()->DefaultValue(-2);
$table->AddColumn('ArmCurl')->MakeInt()->DefaultValue(-2);
$table->AddColumn('StepTest')->MakeInt()->DefaultValue(-2);
$table->AddColumn('FootUpAndGo')->MakeInt()->DefaultValue(-2);
$table->AddColumn('leftunilateralbalancetest')->MakeInt()->DefaultValue(-2);
$table->AddColumn('rightunilateralbalancetest')->MakeInt()->DefaultValue(-2);
$table->AddColumn('FunctionalReach')->MakeInt()->DefaultValue(-2);

return [$table,[]];
?>