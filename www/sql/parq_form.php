<?php

$table = new CreateTable("parq_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('q1-1')->MakeVarChar(11);
$table->AddColumn('q1-2')->MakeVarChar(11);
$table->AddColumn('q1-3')->MakeVarChar(11);
$table->AddColumn('q1-4')->MakeVarChar(11);
$table->AddColumn('q1-5')->MakeVarChar(11);
$table->AddColumn('q1-6')->MakeVarChar(11);
$table->AddColumn('q1-7')->MakeVarChar(11);
$table->AddColumn('q2-1')->MakeVarChar(11);
$table->AddColumn('q2-1a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-1b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-1c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-2')->MakeVarChar(11);
$table->AddColumn('q2-2a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-2b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-3')->MakeVarChar(11);
$table->AddColumn('q2-3a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-3b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-3c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-3d')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-3e')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-4')->MakeVarChar(11);
$table->AddColumn('q2-4a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-4b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-4c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-5')->MakeVarChar(11);
$table->AddColumn('q2-5a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-5b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-6')->MakeVarChar(11);
$table->AddColumn('q2-6a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-6b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-6c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-6d')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-7')->MakeVarChar(11);
$table->AddColumn('q2-7a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-7b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-7c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-8')->MakeVarChar(11);
$table->AddColumn('q2-8a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-8b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-8c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-9')->MakeVarChar(11);
$table->AddColumn('q2-9a')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-9b')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('q2-9c')->MakeVarChar(11)->DefaultValue('UNSANSWERED');
$table->AddColumn('completed')->MakeBool()->DefaultValue('false'); //---------
$table->AddColumn('userID')->MakeInt(100); //---------

return [$table,[]];