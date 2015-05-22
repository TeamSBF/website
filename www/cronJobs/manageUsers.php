<?php

/*
chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";
*/

$select = QueryFactory::Build("select");
// get all rows to users table
$select->Select("id", "activated","created","pLevel","email")->From("users");
        // Get the results from the query execution
$res = DatabaseManager::Query($select);


print_r($res);
if($res->RowCount() > 1)
{
	$res = $res->Result();
	foreach($res as $value)
	{

		if ($value["pLevel"] !=UserLevel::Admin && $value["pLevel"] !=UserLevel::Super && $value["activated"] !=-1)//---------------------------------------- not admin, not deactivated
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
		else if(lateAssessment($value))
		{
			deactivate($value["id"]);
			//check how many assessments were taken
		}
		else if($value["activated"] == -1)
		{
			store($value["id"],$value["email"]);
			remove($value["id"]);
		}
	}
}
}

function lateActivation ($curr)
{
	$selectAct = QueryFactory::Build("select");
	$selectAct->Select("value")->From("settings")->Where(["name","=","ttl_activation"]);
	$ttl= DatabaseManager::Query($selectAct)->Result();
	$time_to_live = $ttl["value"];
	//$time_to_live = "+1 day";
	echo "\nactivation time: ". $ttl;
	if( strtotime($time_to_live,$curr["created"]) < time() && $curr["activated"] == 0)
	{
		return true;
	}
	return false;
}

function lateForms($curr,$time_to_live)
{
	$selectForm = QueryFactory::Build("select");
	$selectForm->Select("value")->From("settings")->Where(["name","=","ttl_activation"]);
	$time_to_live = DatabaseManager::Query($selectForm)->Result();
	echo"\nactivation time: ". $time_to_live;
//	$time_to_live = "+1 month";
	if(strtotime($time_to_live,$curr["created"]) < time())
	{
		if(!FormsModel::isEnrollmentComplete($curr["id"]) || !FormsModel::isParQComplete($curr["id"]) || !FormsModel::isQues1Complete($curr["id"]) || !FormsModel::isQues2Complete($curr["id"]))
		{
			return true;
		}
	}
	return false;
}

function lateAssessments($curr, $time_to_live)
{
		$selectAmt = QueryFactory::Build("select");
	$selectAmt->Select("value")->From("settings")->Where(["name","=","ttl_activation"]);
	$time_to_live = DatabaseManager::Query($selectAmt)->Result();
//	echo"\nactivation time: ". $time_to_live;
	//if need to take next assessment
	if(strtoTime($time_to_live,$curr["NextAssessment"]) < time() && $curr["NextAssessment"] != 0)
	{
		return true;
	}
	return false;
	//check if selected
	//check if late
		//get assessment count
		//if assessment count < 1
			//delete assessments
}

//store users in old user table
fucntion store($id, $email)
{
	$insert= QueryFactory::Build("insert");
	$insert->Into("old_users")->Set(["email", $email], ["id",$id]);
    $inserted = DatabaseManager::Query($insert);
}
//remove user
function remove($id)
{
	$del = QueryFactory::Build("delete");
	$del->Table("users")->Where(["id","=",$id]);
	$deleted = DatabaseManager::Query($del);
}

//deactivate user
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