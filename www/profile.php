<?php
	require_once "header.php";
	if(isset($_POST['update']))
	{
		//********************* GET ALL THE FILEDS FROM THE FORM **************************************
		$oldPass = trim($_POST['oldPass']);
		$newPass = trim($_POST['newPass']); 
		$cNewPass = trim($_POST['cNewPass']);
		$msg = "";
			
		
		if(empty($oldPass) || empty($newPass) || empty($cNewPass))
			$msg = "all fields required";
		else if($newPass !== $cNewPass) // check new pass match
			$msg = "new password doesn't match";
		else // update the password
		{
			require_once("scripts/password.php");
			
			// this below is to grab the current password from the database
			$select = QueryFactory::Build("select");// build an empty select query
			$select->Select("password")->From("users")->Where( ["id", "=", $user->ID] )->Limit(1);  // SELECT password from user where id = id
			$res = DatabaseManager::Query($select); // send to DBmanager
			
			if( password_verify($oldPass, $res->Result()['password']) ) //verify if the current password matches the password in the database
			{
				if(UserModel::updatePassword($user->ID, $newPass)) //updataPassword returns a boolean whether the update is a success or not
					$msg = "Password changed successfully";
				else
					$msg = "Failed to change password";
			}
			else{
				$msg = "Current password doesn't match";
			}
		}	
	}
	// ******************************** FORM ENFORCEMENT REGKEY !!! *************************************************8
?>


<div class="background">
	<?php if(!empty($msg)){?>
		<div><?='* '.$msg;?></div>
	<?php } ?>
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