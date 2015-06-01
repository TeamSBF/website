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


	$arr = array("forgot password","activation","assessment choice", "assessment duration", "assessment frequency","form");

	echo '<div class = "grid_10 omega background">';
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
			'<label>'. $arr[$i] . ' time</label>'.
			'<br><input type="checkbox" name="enabled" value="true"'.$checked.'> Enabled' .
			'<br>currently runs: '. $res[$i]["value"]. '<br>'.
			'<input name="month" type="number" min="0" max ="60" maxlength ="2" size = "4"> : months <br>
		<input name="day" type="number" min="0" max ="60" maxlength ="2" size = "4"> : days <br>
		<input name="hour" type="number" min="0" max ="60" maxlength ="2" size = "4"> : hours <br>
		<br>
		<button name ="submit" type="submit" value="submit '.$arr[$i].'">'.$arr[$i].'</button>
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