<?php
//path to cronJobs file
$path = "cronJobs/";

//path to config and sessions
chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";

//read all rows from schedule table
$select = QueryFactory::Build("select");
$select->Select("name", "frequency","lastRun" )->From("schedule");

$res = DatabaseManager::Query($select);
$res2 = $res->Result();

// iterate through each task and proccess
if($res->RowCount() > 1 )
{
	foreach($res2 as $curr)
	{
		process($curr);
	}
}

//edge case of only one task
else if($res->RowCount() == 1)
{
	process($res2);
}

private function process ($curr)
{
	//if need to run task
	if( strtotime($curr["frequency"],$curr["lastRun"]) < time())
	{
			//run job
			//note working out of www dir
			require_once($path.$curr["name"]);
		
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