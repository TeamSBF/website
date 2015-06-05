<?php
require_once("header.php");
//do if plevel admin or super

if($user->AccessLevel == UserLevel::Admin || $user->AccessLevel == UserLevel::Super)
{
	$err= "";
	if(!empty($_POST))
	{

		array_walk($_POST, create_function('&$val', '$val = trim($val);')); 
		array_walk($_POST, create_function('&$val', '$val = htmlspecialchars($val);')); 
//		print_r($_POST);
		$cronVal = new CronValidator($_POST);
		$err = $cronVal->validate();
	}


//get activation time info
	$selectAct = QueryFactory::Build("select");
	$selectAct->Select("value","enabled")->From("settings")->Where(["name","=","ttl_activation"]);
	$Res_Act = DatabaseManager::Query($selectAct)->Result();
	
	$selectForm = QueryFactory::Build("select");
	$selectForm->Select("value","enabled")->From("settings")->Where(["name","=","ttl_form"]);
	$Res_Form = DatabaseManager::Query($selectForm)->Result();
	
	$selectAss_Freq = QueryFactory::Build("select");
	$selectAss_Freq->Select("value","enabled")->From("settings")->Where(["name","=","ttl_assessment_frequency"]);
	$Res_Ass_Freq = DatabaseManager::Query($selectAss_Freq)->Result();

	$selectAss_Comp = QueryFactory::Build("select");
	$selectAss_Comp->Select("value","enabled")->From("settings")->Where(["name","=","ttl_assessment_complete"]);
	$Res_Ass_Comp = DatabaseManager::Query($selectAss_Comp)->Result();
?>

<?php
//make partals here
/*
$input = PartialParser::Parse('button', ["value" => "Save", "type" => "submit", "id" => "save"]);
$data["content"];
$data["method"] = "POST";
$form = PartialParse::Parse("form", $data);
*/
?>

<?php
//for loop

	$arr = array("activation", "form", "assessment frequency", "assessment duration");
	$results = array($Res_Act, $Res_Form, $Res_Ass_Freq,$Res_Ass_Comp);
	echo '<div class="background">';

	for($i=0; $i < count($arr); $i = $i+1)
	{
		if($results[$i]["enabled"])
			$checked = "checked";
		else
			$checked = "";
		if($i % 2 ==0)
		{
			echo '<div class="grid_6 alpha">';
		}
		echo '<form method = "POST">' .
			'<label>'. $arr[$i] . ' time</label>'.
			'<br><input type="checkbox" name="enabled" value="true"'.$checked.'> Enabled' .
			'<br>currently runs: '. $results[$i]["value"]. '<br>'.
			'<input name="months" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : months <br>
		<input name="days" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : days <br>
		<input name="hours" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : hours <br>
		<input name="minutes" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : min <br>
		<input name="seconds" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : seconds
		<br>
		<input name="submit" type = "submit" value = "submit '. $arr[$i].'">
		</form><br>';
		
		if($i % 2 ==0)
		{
			echo '</div>';
		}
	}
	echo '</div>';
}
else
{
	//dont belong
	$session->forget();
	header("location: index.php");
}
?>

<?php
require_once("footer.php");
?>