<?php
require_once("header.php");

/*
if(isset($user) && ($user->AccessLevel == UserLevel::Admin || $user->AccessLevel == UserLevel::Super))
{
*/ 
	$err= "";
	if(!empty($_POST))
	{
		array_walk($_POST, create_function('&$val', '$val = trim($val);')); 
		array_walk($_POST, create_function('&$val', '$val = htmlspecialchars($val);')); 
		$cronVal = new CronValidator($_POST);
		$err = $cronVal->validate();
	}

	
	$selectAct = QueryFactory::Build("select");
	$selectAct->Select("value","enabled")->From("settings");
	$res = DatabaseManager::Query($selectAct)->Result();
?>

<?php


	$arr = array("forgot password duration","activation duration","assessment choice duration", "assessment duration", "assessment frequency","forms duration");
	$description= array("The amount of time a forgot password link will stay active before a user request another link",
						"The amount of time a user has to activate their account after registering before that account is deleted",
						"The amount of time a user has to choose which assessments they want to take",
						"The amount of time a user has to take an assessment once active",
						"The amount of time between each assessment",
						"The amount of time a user has to complete their forms");
	echo '<div class = "grid_10 alpha background">';
	
		//----------
		echo '<h1>Settings</h1>';
		echo '<p>Below you can change the time limits for each item as well as enable or disable them. For more information hover mouse over item.</p>';
	
		//-----------
		echo '<div class="grid_6 alpha">';

	for($i=0; $i < count($arr); $i = $i+1)
	{
		if($res[$i]["enabled"])
			$checked = "checked";
		else
			$checked = "";
		if($i == round(count($arr)/2))
		{
			echo '</div> <div class="grid_6 omega">';
		}
		echo '<form method = "POST">' .
			'<label title="'.$description[$i].'">'. $arr[$i] . '</label>'.
			'<br><input title="enable or disable this feature" type="checkbox" name="enabled" value="true"'.$checked.'> Enabled' .
			'<br>currently runs: '. $res[$i]["value"]. '(s)<br>'.
			'<input title="number of months from 0-60" name="month" type="number" min="0" max ="60" maxlength ="2" size = "4"> : months <br>
		<input title="number of days from 0-60" name="day" type="number" min="0" max ="60" maxlength ="2" size = "4"> : days <br>
		<input title="number of hours from 0-60" name="hour" type="number" min="0" max ="60" maxlength ="2" size = "4"> : hours <br>
		<br>
		<button title="submit the changes for '.$arr[$i].'" name ="submit" type="submit" value="'.$arr[$i].'">'.$arr[$i].'</button>
		</form><br>';
		
	}
		echo '</div>';
	echo '</div>'; 
/*
}
else
{
	//dont belong
	$session->forget();
	header("location: index.php");
}
*/
?>

<?php
require_once("footer.php");
?>