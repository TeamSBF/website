<?php
//---------------------------------
//path to cronJobs file
$path = "cronJobs/";

//path to config and sessions
chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";
//----------------------------------------
$select = QueryFactory::Build("select");
// get all rows to users table
$select->Select("id", "email","created","password","pLevel","activated" )->From("users");
        // Get the results from the query execution
$res = DatabaseManager::Query($select);

if($res->RowCount() > 1)
{
	$res = $res->Result();
	
	foreach($res as $row)
	{
		//if not admin                                get from settings?
		if(!$row["activated"] && time() > strtotime("+1 days",$row["created"]))
		{
			//delete user
			$del = QueryFactory::Build("delete");
			$del->Table("users")->Where(["id","=",$row["id"]]);
			$deleted = DatabaseManager::Query($del);

		}
	}
}

?>