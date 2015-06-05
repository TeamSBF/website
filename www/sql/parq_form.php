<?php

$table = new CreateTable("parq_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('userID')->MakeInt()->AddKey('unique');
$table->AddColumn('DateCompleted')->MakeInt()->DefaultValue(0);
$table->AddColumn('completed')->MakeBool()->DefaultValue('false');
$table->AddColumn('q1_1')->MakeInt();
$table->AddColumn('q1_2')->MakeInt();
$table->AddColumn('q1_3')->MakeInt();
$table->AddColumn('q1_4')->MakeInt();
$table->AddColumn('q1_5')->MakeInt();
$table->AddColumn('q1_6')->MakeInt();
$table->AddColumn('q1_7')->MakeInt();
$table->AddColumn('q2_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_1_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_1_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_1_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_2_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_2_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3_4')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_3_5')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_4')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_4_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_4_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_4_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_5')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_5_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_5_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_6')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_6_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_6_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_6_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_6_4')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_7')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_7_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_7_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_7_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_8')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_8_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_8_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_8_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_9')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_9_1')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_9_2')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q2_9_3')->MakeInt()->DefaultValue(-1);
$table->AddColumn('q3_1')->MakeVarChar(50);
$table->AddColumn('q3_2')->MakeVarChar(50);
$table->AddColumn('q3_3')->MakeVarChar(50)->DefaultValue("none");

return [$table,[]];