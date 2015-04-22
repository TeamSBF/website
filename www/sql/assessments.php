<?php

$table = new CreateTable("assessments");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('userid')->MakeInt();
$table->AddColumn('testnumber')->MakeInt();
$table->AddColumn('30secondchairstand')->MakeInt();
$table->AddColumn('armcurl')->MakeInt();
$table->AddColumn('2minutesteptest')->MakeInt();
$table->AddColumn('8footupandgo')-><MakeFloat();
$table->AddColumn('leftunilateralbalancetest')->MakeFloat();
$table->AddColumn('rightunilateralbalancetest')->MakeFloat();
$table->AddColumn('functionalreach')->MakeInt();


return $table;