<?php
$name = basename(__FILE__, ".php");
$table = new CreateTable($name);
$table->AddColumn("id")->SetAutoIncrement();
$table->AddColumn("title")->MakeVarChar(100);
$table->AddColumn("content")->MakeText();
$table->AddColumn("created")->MakeInt();
$table->AddColumn("viewby")->MakeTinyInt()->DefaultValue(0);

$info = array();
$insert = QueryFactory::Build("insert");
$info[] = $insert->Into($name)->Set(
                        ["title", 'Welcome to Sit and Be Fit "Feel the difference" Project!'],
                        ["content", '<p>Welcome to the Feel the Difference project website. We are reaching'.
                                    'out to adults 55+ and/or those managing chronic conditions with an invitation'.
                                    'to participate in an important research study to determine the effectiveness'.
                                    'of the Sit and Be Fit exercise program</p>'.
                                    '<iframe width="100%" height="360" src="https://www.youtube.com/embed/31Ew1ogQqpE" frameborder="0" allowfullscreen></iframe>'],
                        ["created","UNIX_TIMESTAMP()"],
                        ["viewby",UserLevel::Anon]
                        );

return [$table, $info];