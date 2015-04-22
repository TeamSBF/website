<?php
$name = "users";
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('password')->MakeVarChar(100);
$table->AddColumn('pLevel')->MakeInt()->DefaultValue('1');
$table->AddColumn('created')->MakeInt();
$table->AddColumn('activated')->MakeBool()->DefaultValue('false');

$population = array();
$population[] = QueryFactory::Build("insert")->Into($name)->Set(["email", "admin@sbf.org"], ["password", "$2y$11$593EkWGKJ.1dkCN/ivW1OOOf180ijPxRPyaUr7w79fWFJmQUNietK"], ["created", "UNIX_TIMESTAMP()"],["pLevel",3]);

return [$table, $population];