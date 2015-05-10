table<?php

/*-------------------------------for testing
//path to cronJobs file
$path = "cronJobs/";

//path to config and sessions
chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";
//----------------------------------------*/


select = QueryFactory::Build("select");
// get all rows to users table
$select->Select("id", "activated","created","pLevel")->From("users");
        // Get the results from the query execution
$res = DatabaseManager::Query($select)->Result();

foreach($res as $value)
{
	//if ($res["pLevel"] < admin)//----------------------------------------
	//{
		if(lateActivation($res))
		{
			deactivate($res["id"]);
		}
		else if(lateForms($res))
		{
			deactivate($res["id"]);
		}
		else
		{
			checkAssessments($res);
		}
	//}
}

function lateActivation ($curr)
{
	//read from settings
	$time_to_live = "+1 day";
	if( strtotime($curr["created"],$time_to_live) < time() && !$$curr["activated"])
	{
		return true	;
	}
	return false;
}

function lateForms($res)
{
	//read from settings?
	$time_to_live = "+1 month";
	if(strtotime($curr["created"],$time_to_live) < time())
	{
		if(!FormModel::isEnrollmentCompleteed($curr["id"]) || !FormModel::isParQComplete($curr["id"]) || !FormModel::isQues1Complete($curr["id"]) || !FormModel::isQues2Complete($curr["id"]))
		{
			return true
		}
	}
	return false;
}

function checkAssessments($curr)
{
	//check if late
		//get assessment count
		//if assessment count < 1
			//delete assessments
}

private function remove($id)
{
	$del = QueryFactory::Build("delete");
	$del->Table("users")->Where(["id","=",$row["id"]]);
	$deleted = DatabaseManager::Query($del);
}

private function deactivate($id)
{
	$update = QueryFactory::Build('update');
	$update->Table('users')->Set(['activated',0])->Where(['id','=', $id]);
	$temp = DtatbaseManager::Query($update);
	
	if($temp->RowCount()==1)
		echo "deactivated ". $id;
	else
		echo "failed to deactivate ". $id;
}
?>