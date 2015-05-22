<?php
$name = "settings";
$table = new CreateTable($name);
//$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('name')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('value')->MakeVarchar(100);
$table->AddColumn('enabled')->MakeBool()->DefaultValue('true');

$population = Array();
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ttl_activation"],["value","+1 day"]);
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ttl_form"],["value","+1 month"]);
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ttl_assessment_choice"],["value","+2 weeks"]);
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ttl_assessment_complete"],["value","+1 month"]);
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ttl_assessment_frequency"],["value","+3 month"]);

return[$table,$population];
?>