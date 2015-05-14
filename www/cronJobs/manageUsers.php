<?php

/*
//path to cronJobs file
$path = "cronJobs/";

//path to config and sessions
chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";

*/

$select = QueryFactory::Build("select");
// get all rows to users table
$select->Select("id", "activated","created","pLevel")->From("users");
        // Get the results from the query execution
$res = DatabaseManager::Query($select)->Result();


foreach($res as $value)
{
	if ($value["pLevel"] != 3 && $value["activated"] !=-1)//---------------------------------------- not admin, not deactivated
	{
//		echo $value["id"] . " is: <br>"; 
		if(lateActivation($value))
		{
//			echo "not activated <br>";
			remove($value["id"]);
		}
		else if(lateForms($value))
		{
//			echo "late with forms <br>";
			deactivate($value["id"]);
		}
		else
		{
			//checkAssessments($res);
		}
	}
}


function lateActivation ($curr)
{
	//read from settings
	$time_to_live = "+1 day";
	if( strtotime($time_to_live,$curr["created"]) < time() && $curr["activated"] == 0)
	{
		return true;
	}
	return false;
}

function lateForms($curr)
{
	//read from settings?
	$time_to_live = "+1 month";
	if(strtotime($time_to_live,$curr["created"]) < time())
	{
		if(!FormsModel::isEnrollmentComplete($curr["id"]) || !FormsModel::isParQComplete($curr["id"]) || !FormsModel::isQues1Complete($curr["id"]) || !FormsModel::isQues2Complete($curr["id"]))
		{
			return true;
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
	return 1;
}


function remove($id)
{
	$del = QueryFactory::Build("delete");
	$del->Table("users")->Where(["id","=",$id]);
	$deleted = DatabaseManager::Query($del);
}

function deactivate($id)
{
	$update = QueryFactory::Build('update');
	$update->Table('users')->Set(['activated',-1])->Where(['id','=', $id]);
	$temp = DatabaseManager::Query($update);
	
	if($temp->RowCount()==1)
		echo "deactivated ". $id;
	else
		echo "failed to deactivate ". $id;
}

?>