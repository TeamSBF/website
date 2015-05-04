<?php
//path to cronJobs file


//path to config and sessions
chdir('..');
require_once "config.php";
require_once "sessions.php";

//read all rows from schedule table
$select = QueryFactory::Build("select");
$select->Select("name", "frequency","lastRun" )->From("schedule");

$res = DatabaseManager::Query($select);
$res2 = $res->Result();
if($res->RowCount() > 1 )
{
	foreach($res2 as $curr)
	{
		process($curr);
	}
}
//if only one job
else if($res->RowCount() == 1)
{
	process($res2);
}



function process ($curr)
{
	$path = "cronJobs/";
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
			if($success)
				echo $curr['name'] . " updated";
			else
				echo $curr['name'] . " failed";
	}
}
?>