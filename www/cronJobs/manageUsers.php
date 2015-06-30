<?php
		echo"\nstart";

chdir('..');

//needed to use models
require_once "config.php";
require_once "sessions.php";

$myfile = fopen("ManageUsers.txt", "a");
fwrite($myfile,"\nstart-------------------------\n");
//get all user info
$select = QueryFactory::Build("select");
$select->Select("id", "activated","created","pLevel","email","NextAssessment")->From("users");
$res = DatabaseManager::Query($select);

if($res->RowCount() > 1)
{
	fwrite($myfile,"\nres count = ".$res->RowCount() . "\n");
	
	$res = $res->Result();
	fwrite($myfile,"array count = ".count($res)." \nAll rows\n");

	foreach($res as $value)
	{
		fwrite($myfile,'id: '.$value["id"]." email: ".$value["email"]." created: ".$value["created"]." \n");
		
		if ($value["pLevel"] !=UserLevel::Admin && $value["pLevel"] !=UserLevel::Super)
		{
			fwrite($myfile,": not an admin");
			
			if(lateActivation($value))
			{
				fwrite($myfile,": late activation");
				remove($value["id"]);
			}
			if(lateForms($value))
			{
				fwrite($myfile,": late forms");
				store($value["id"],$value["email"]);
				remove($value["id"]);
			}
			if(lateAssessment($value))
			{
				fwrite($myfile,": late forms");
				//if first assessment
					//store assessment
					
				store($value["id"],$value["email"]);
			}
			if(needAssessmentReminder($curr,$myfile))
			{
				fwrite($myfile,": need reminder");
			}

		}
		fwrite($myfile,"\n");
	}
	fwrite($myfile,"\n---------------------------------\n");
	
	fwrite($myfile,"reading rows\n");
	foreach($res as $value)
	{
		fwrite($myfile,'id: '.$value["id"]." email: ".$value["email"]."\n");
		//if not admin or super
		
		
		if ($value["pLevel"] !=UserLevel::Admin && $value["pLevel"] !=UserLevel::Super && $value["activated"] !=-1)
		{
			

			//fwrite($myfile,'id: '.$value["id"]." activated: ".$value["activated"]." pLevel: ".$value["pLevel"]." email: ".$value["email"]."\n");
			//check if user in not activated
			if(lateActivation($value))
			{
				fwrite($myfile,"\nlate activation\n");
				remove($value["id"]);
			}
			//check if user has forms completed
			else if(lateForms($value))
			{
				fwrite($myfile,"\nlate with forms \n");
				deactivate($value["id"]);
			}
			//check if user had assessments completed
			else if(lateAssessment($value))
			{
				fwrite($myfile, "\ndeactivated\n");
				deactivate($value["id"]);
			}
			
			//check if email reminder is needed
			else if(needAssessmentReminder($curr))
			{
				remind($curr);
			}
			
			//store disabled users
			if($value["activated"] == -1)
			{
				store($value["id"],$value["email"]);
				remove($value["id"]);
			}
		}
	}
	
	fwrite($myfile,"\n------------------------end\n");
}

function remind($curr) //---------------- needs testing
{
	//update reminder value
	$assessments = getLastAssessment($curr);
	$update = QueryFactory::Build("update");
	$update->Table("assessments")->Where(["id","=",$curr["id"]],["TestNumber","=",$assessments["TestNumber"]])->Set(["reminded","1"]);
	$cinfo = DatabaseManager::Query($complete);
	
	//write email						
	Mailer::Send($curr["email"],"This is an email reminder that your Sit And Be Fit assessment is due in a week./nPlease go to sbfresearch.org and login to complete the assessment"); 
}
function getLastAssessment($curr) // ----------needs testing
{
	
	$assessments = QueryFactory::Build("select");
	$assessments->Select("reminded","dateCompleted","TestNumber")->Where(["id","=", $curr["id"]])->From("assessments");
	$assessments=DatabaseManager::Query($assessments);
	$count = $assessments->RowCount();
	
	$assessments= $assessments->Result();	
	
	$reminded = false;

	//iterate to latest assessment
	if($count >1)
	{
		$max = -1;
		$index=-1;
		for($i=0; $i<$count; $i++)
		{
			if($curr["TestNumber"] > $max)
				$index = $i;
		}
		$assesments = $assessments[$index];
	}
	return assessments;
}
function needAssessmentReminder($curr) //--------------needs testing
{
	$assessments = getLastAssessment($curr);
	//get assessment lifespan from db
	$ttl = QueryFactory::Build("select");
	$ttl->Select("value")->Where(["name","=", "ttl_assessment_complete"])->From("settings");
	$ttl=DatabaseManager::Query($ttl)->Result();
		
	//if not reminded and time to
	if(isset($assessments) && !$assessments["reminded"] && strtotime(ttl,time()) > $strtotime("-1 week",$curr["NextAssessment"]))
	{
		return true;
	}
	return false;
}


//function getLastTest($id)

function lateActivation ($curr)
{
	$selectAct = QueryFactory::Build("select");
	$selectAct->Select("value","enabled")->From("settings")->Where(["name","=","ttl_activation"]);
	$ttl= DatabaseManager::Query($selectAct)->Result();
	$time_to_live = $ttl["value"];
	
	if($ttl["enabled"] && strtotime($time_to_live,$curr["created"]) < time())
		return true;
	
	return false;
}

function lateForms($curr)
{
	$selectForm = QueryFactory::Build("select");
	$selectForm->Select("value","enabled")->From("settings")->Where(["name","=","ttl_form"]);
	$time_to_live = DatabaseManager::Query($selectForm)->Result();
//	echo"\nactivation time: ". $time_to_live;
//	$time_to_live = "+1 month";
	if($time_to_live["enabled"] && strtotime($time_to_live["value"] ,$curr["created"]) < time())
	{
		if(!FormsModel::isEnrollmentComplete($curr["id"]) || !FormsModel::isParQComplete($curr["id"]) || !FormsModel::isQues1Complete($curr["id"]) || !FormsModel::isQues2Complete($curr["id"]))
		{
			return true;
		}
	}
	return false;
}

function lateAssessment($curr)
{	
	$selectAmt = QueryFactory::Build("select");
	$selectAmt->Select("value","enabled")->From("settings")->Where(["name","=","ttl_assessment_complete"]);
	$time_to_live = DatabaseManager::Query($selectAmt)->Result();

	//if need to take next assessment
	if($time_to_live['enabled'] && $curr["NextAssessment"] != 0 && strtoTime($time_to_live['value'] ,$curr["NextAssessment"]) < time() )
	{
		return true;
	}
	return false;
}

//store users in old user table
function store($id, $email)
{
//	try
//	{
	$insert = QueryFactory::Build("insert");
        // Build the insert query
    $insert->Into("old_users")->Set(["email", $email], ["id", $id]);
        // Execute the query and get the result
     $qinfo = DatabaseManager::Query($insert);
//	}
/*	catch (Exception $e)
	{
		fwrite($strfl, "\nerror: ". $e->getMessage(). "\n");
		echo"error";
	}
*/
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