<?php
$name = basename(__FILE__,".php");
$table = new CreateTable($name);
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('name')->MakeVarChar(20)->AddKey('unique');
$table->AddColumn('page')->MakeVarChar(30)->DefaultValue("index.php");
$table->AddColumn('pLevel')->MakeInt();

$populate = array();
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Home"],["page","index.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","About"],["page","about.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Contact"],["page","contact.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","FAQ"],["page","faq.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Assessments"],["page","assessments.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Register"],["page","register.php"]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Profile"],["page","profile.php"],["pLevel",1]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","ParQ Form"],["page","parQ.php"],["pLevel",1]);
$populate[] = QueryFactory::Build("insert")->Into($name)->Set(["name","Logout"],["page","logout.php"],["pLevel",1]);

return [$table, $populate];