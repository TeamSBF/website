<?php

//	$myfile = fopen("CronFile.txt", "a");
//	fwrite($myfile, "cron starts at ". getcwd());
//	fwrite($myfile,"\nstart-------------------------\n");
//chdir('../'); // to www folder

	
//path to config and sessions
chdir('www/'); //dependent on where cron runs from
//chdir('../');
//fwrite($myfile, "working in ". getcwd()."\n");//--------------------
//needed to use models
require_once "config.php";
require_once "sessions.php";
//read all rows from schedule table
$select = QueryFactory::Build("select");

$select->Select("name", "frequency","lastRun" )->From("schedule");
$res = DatabaseManager::Query($select);
$res2 = $res->Result();

//$res2['name']= "qwerty";
/*fwrite($myfile, "error info is ".$res->Errors(). " !!!");
//fwrite($myfile, "\nis a ".gettype($res2['name']). "of size " .strlen($res2['name']));
if(isset($res2["name"]))
	fwrite($myfile,"\nres2 is set\n");
if(empty($res2["name"]))
	fwrite($myfile,"\nres2 is empty\n");
*/
$name = $res2["name"];
//fwrite($myfile,"\nres2: ".$res2["name"]. " !!!");
// iterate through each task and proccess
//fwrite($myfile, "\nrowcount: ". $res->RowCount()."\n");//----------------------
if($res->RowCount() > 1 )
{
//	fwrite($myfile, "in first if\n");//------------------------
	foreach($res2 as $curr)
	{
	//	fwrite($myfile,"prosess\n");//--------------------------------
		process($curr);
		
	}
}

//edge case of only one task
else if($res->RowCount() == 1)
{
//	fwrite($myfile ,"other prosess\n");//---------------------------------------
//	fclose($myfile);
	process($res2);
//	$myfile = fopen("CronFile.txt", "a");//--------------
//	fwrite($myfile, "\nfinished other process\n")
}

//fwrite($myfile, "\n------------------end-------------\n");
fclose($myfile);

function process ($curr)
{
//	$myfile = fopen("CronFile.txt", "a");//--------------
//	fwrite($myfile, "\n**processing**\n");
	//if need to run task
//	fwrite($myfile,"curr is ".printr($curr));
	if( strtotime($curr["frequency"],$curr["lastRun"]) < time())
	{
	
//	fwrite($myfile, $curr["name"] . ": ");
//	fwrite($myfile, $curr["frequency"]."/n");
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
	fclose($myfile);
}
?>