<?php

$table = QueryFactory::CreateTable("users");
$table->AddColumn('id')->AddAttribute('int','11');

return $table;
/*
  "CREATE TABLE `users` (" .
  "`id` int(11) NOT NULL," .
  "`email` varchar(100) NOT NULL," .
  "`password` varchar(100) NOT NULL," .
  "`created` int(11) NOT NULL," .
  "`activated` tinyint(1) NOT NULL DEFAULT '0'" .
  ") ENGINE=InnoDB DEFAULT CHARSET=utf8;" .
  "ALTER TABLE `users`" .
  "ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);";
*/