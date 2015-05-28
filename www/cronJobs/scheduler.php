<?php

//	$myfile = fopen("CronFile.txt", "a");
	//fwrite($myfile, "cron starts at ". getcwd());
//	fwrite($myfile,"\nstart-------------------------\n");
//	fclose($myfile);
//chdir('../'); //dependent on where cron runs from

	
//path to config and sessions
chdir('www/'); //dependent on where cron runs from
//chdir('../');

//needed to use models
require_once "config.php";
require_once "sessions.php";

//read all rows from schedule table
$select = QueryFactory::Build("select");
$select->Select("name", "frequency","lastRun" )->From("schedule");

$res = DatabaseManager::Query($select);
$res2 = $res->Result();
//fclose($myfile);//-----------------------------
// iterate through each task and proccess
if($res->RowCount() > 1 )
{
//	fwrite($myfile, "in first if\n");//------------------------
	foreach($res2 as $curr)
	{
//		fwrite($myfile,"prosess\n");//--------------------------------
		process($curr);
	}
}

//edge case of only one task
else if($res->RowCount() == 1)
{
//	fwrite($myfile ,"other prosess\n");//---------------------------------------
	process($res2);
}

//fclose($myfile);

function process ($curr)
{

	echo $curr["name"] . ": ";
	echo $curr["frequency"]."<br>";
	//if need to run task
	if( strtotime($curr["frequency"],$curr["lastRun"]) < time())
	{
		//run job		
		include(__DIR__ . '/'. $curr["name"]);
		
		//update last run time
		$ran = QueryFactory::Build('update');
		$ran->Table("schedule")->Set(["lastRun", time()])->Where(["name", '=', $curr["name"]]);
		$success=DatabaseManager::Query($ran);
		
		//for testing
		if($success->RowCount() > 0)
			echo $curr['name'] . " updated";
		else
			echo $curr['name'] . " failed";
	}
}
?>