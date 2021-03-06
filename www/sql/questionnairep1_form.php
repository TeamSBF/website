<?php

$table = new CreateTable("questionnairep1_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('userID')->MakeInt()->AddKey('unique');
$table->AddColumn('completed')->MakeBool()->DefaultValue('false');
$table->AddColumn('q1')->MakeInt();
$table->AddColumn('q2')->MakeInt();
$table->AddColumn('q3')->MakeInt();
$table->AddColumn('q4')->MakeInt();
$table->AddColumn('q5')->MakeInt();
$table->AddColumn('q6')->MakeInt();
$table->AddColumn('q7')->MakeInt();
$table->AddColumn('q8')->MakeInt();
$table->AddColumn('q9')->MakeInt();
$table->AddColumn('q10')->MakeInt();
$table->AddColumn('q11')->MakeInt();
$table->AddColumn('q12')->MakeInt();
$table->AddColumn('q13')->MakeInt();
$table->AddColumn('q14')->MakeInt();
$table->AddColumn('q15')->MakeInt();
$table->AddColumn('q16')->MakeInt();
$table->AddColumn('q17')->MakeInt();
$table->AddColumn('q18')->MakeInt();
$table->AddColumn('q19')->MakeInt();
$table->AddColumn('q20')->MakeInt();
$table->AddColumn('q21')->MakeInt();
$table->AddColumn('q22')->MakeVarChar(500)->DefaultValue("none");
$table->AddColumn('q23')->MakeInt();
$table->AddColumn('q24')->MakeInt();
$table->AddColumn('q25')->MakeInt();
$table->AddColumn('q26')->MakeVarChar(500)->DefaultValue("none");
$table->AddColumn('q27')->MakeInt();
$table->AddColumn('q28')->MakeInt();
$table->AddColumn('q29')->MakeInt();

return [$table,[]];