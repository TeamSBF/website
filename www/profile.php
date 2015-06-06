<?php require_once "header.php";
$msg = "";
// if the user press UPDATE
if(isset($_POST['update']))
{
	//********************* GET ALL THE FILEDS FROM THE FORM **************************************
	$oldPass = trim(strip_tags($_POST['oldPass']));
	$newPass = trim(strip_tags($_POST['newPass'])); 
	$cNewPass = trim(strip_tags($_POST['cNewPass']));
		
	//******************* this block below is where we validate input from user ***********************
	if(empty($oldPass) || empty($newPass) || empty($cNewPass))
		$msg = ["all fields required",0];
	else if($newPass !== $cNewPass) // check if the newPassword match
		$msg = ["new password doesn't match",0];
	else // update the password
	{
		require_once("scripts/password.php");
		
		// this below is to grab the current password from the database
		$select = QueryFactory::Build("select");// build an empty select query
		$select->Select("password")->From("users")->Where( ["id", "=", $user->ID] )->Limit(1);  // SELECT password from user where id = id
		$res = DatabaseManager::Query($select); // send to DBmanager
		
		if(password_verify($oldPass, $res->Result()['password'])) //verify if the current password matches the password in the database
		{
			if(UserModel::updatePassword($user->ID, $newPass)) //updataPassword returns a boolean whether the update is a success or not
				$msg = ["Password changed successfully",1];
			else
				$msg = ["Failed to change password",0];
		}
		else
		{
			$msg = ["Current password doesn't match",0];
		}
	}	
}
// ******************************** FORM ENFORCEMENT REGKEY !!! *************************************************8
?>


<div class="background">
	<?php if(is_array($msg)) echo PartialParser::Parse("div",["content"=>$msg[0], "classes"=>($msg[1] === 1?"success":"error")]); ?>
	<h1> Change Password </h1>
	<form class="changePassword" method="POST">
		<div class="labels"><label>Current password </label></div>
		<div class="inputFields"><input type="password" name="oldPass" placeholder="" required></div> 
		<div class="labels"><label>New Password</label></div> 
		<div class="labels"><label>(minimum 6 characters) </label></div>
		<div class="inputFields"><input type="password" name="newPass" placeholder="" required></div> 		
		<div class="labels"><label>Confirm New Password </label></div>
		<div class="labels"><label>(minimum 6 characters) </label></div>
		<div class="inputFields"><input type="password" name="cNewPass" placeholder="" required></div> 	
		<div class="inputFields"><button type="submit" name="update" value="update">update</button></div>
	</form>
	</div>
</div>
	
<?php require_once"footer.php";?>