<?php
require_once("header.php");
//do if plevel admin or super
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
	$selectAct->Select("value")->From("settings")->Where(["name","=","ttl_activation"]);
	$Res_Act = DatabaseManager::Query($selectAct)->Result();
	
	$selectForm = QueryFactory::Build("select");
	$selectForm->Select("value")->From("settings")->Where(["name","=","ttl_form"]);
	$Res_Form = DatabaseManager::Query($selectForm)->Result();
	
	$selectAss = QueryFactory::Build("select");
	$selectAss->Select("value")->From("settings")->Where(["name","=","ttl_assessment_frequency"]);
	$Res_Ass = DatabaseManager::Query($selectAss)->Result();
//	$Res["value"] = str_replace("_", " ", $Res["value"]);
//	echo $Res["value"];
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
/*
$arr = array("activation", "form", "assessment");
$results = array($Res_Act, $Res_Form, $Res_Ass);
echo '<div class="background">';
for($i=0; i < count($arr); $i++)
{
	echo '<form method = "POST">' .
			'<label>'. $arr[$i] . ' time</label>'.
			'<br>currently runs: '. $results[$i]. '<br>'.
			'<input name="months" type="number" min="0" max ="9999" maxlength ="4" size = "4">:months <br>
		<input name="days" type="number" min="0" max ="9999" maxlength ="4" size = "4"> :days <br>
		<input name="hours" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : hours <br>
		<input name="minutes" type="number" min="0" max ="9999" maxlength ="4" size = "4">: min <br>
		<input name="seconds" type="number" min="0" max ="9999" maxlength ="4" size = "4">: seconds
		<br>
		<input name="submit" type = "submit" value = "submit activation">
	</form>
	
	<form method="POST">';
}
echo '</div>';
*/
?>
<div class="background">

	<?php echo $err;?>

	<form method="POST">
		<label>activation time: </label>
		<br>
		currently runs: <?php echo $Res_Act["value"];?>
		<br>
		<input name="months" type="number" min="0" max ="9999" maxlength ="4" size = "4">:months <br>
		<input name="days" type="number" min="0" max ="9999" maxlength ="4" size = "4"> :days <br>
		<input name="hours" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : hours <br>
		<input name="minutes" type="number" min="0" max ="9999" maxlength ="4" size = "4">: min <br>
		<input name="seconds" type="number" min="0" max ="9999" maxlength ="4" size = "4">: seconds
		<br>
		<input name="submit" type = "submit" value = "submit activation">
	</form>
	
	<br>
	
	<form method="POST">
		<label>form time: </label>
		<br>
		currently runs: <?php echo $Res_Form["value"];?>
		<br>
		<input name="months" type="number" min="0" max ="9999" maxlength ="4" size = "4">:months <br>
		<input name="days" type="number" min="0" max ="9999" maxlength ="4" size = "4"> :days <br>
		<input name="hours" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : hours <br>
		<input name="minutes" type="number" min="0" max ="9999" maxlength ="4" size = "4">: min <br>
		<input name="seconds" type="number" min="0" max ="9999" maxlength ="4" size = "4">: seconds
		<br>
		<input name="submit" type = "submit" value = "submit form">
	</form>
	<br>
	<form method="POST">
		<label>assessment time: </label>
		<br>
		currently runs: <?php echo $Res_Ass["value"];?>
		<br>
		<input name="months" type="number" min="0" max ="9999" maxlength ="4" size = "4">:months <br>
		<input name="days" type="number" min="0" max ="9999" maxlength ="4" size = "4"> :days <br>
		<input name="hours" type="number" min="0" max ="9999" maxlength ="4" size = "4"> : hours <br>
		<input name="minutes" type="number" min="0" max ="9999" maxlength ="4" size = "4">: min <br>
		<input name="seconds" type="number" min="0" max ="9999" maxlength ="4" size = "4">: seconds
		<br>
		<input name="submit" type = "submit" value = "submit assessment">
	</form>

</div>

<?php
//
require_once("footer.php");
?>