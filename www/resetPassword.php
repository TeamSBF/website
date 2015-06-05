<?php
	require_once "header.php";
	require_once "config.php";
	
	//if the user press RESET
	if(isset($_POST['reset']) )
	{
		$server = $_SERVER['SERVER_NAME'];
		$id = Validator::instance()->sanitize("int", $_GET['id']);//get the ID to prevent people from inserting their own ID
		
		// *********************************  GET HASH FROM DATABASE TO CHECK AGAINST THE HASH COMING FROM THE LINK
		$select = QueryFactory::Build("select");
		$select->Select("id","salt", "salt_time")->From("users")->Where(["id","=",$id])->Limit();
		$res = DatabaseManager::Query($select)->Result();
		$saltTime = $res["salt_time"];
		$userIDHash = sha1($res["id"].$res["salt"]);
		
		// compare saltTime ( link creation time ) against current time to see if link is still valid
		if($saltTime < time()) // if creation time is greater than current time, the link is invalid
			$msg = "This reset password link has been expired, please get a new one from forgot password";
		else if($userIDHash === $_GET['link'])  // link is valid ( both lifetime and link matches from database) go ahead and reset the password
		{
			// get the new passwords from the form
			$msg = "";
			$newPass = trim( strip_tags($_POST['newPass']));
			$cNewPass = trim( strip_tags($_POST['cNewPass']));
			
			// validate the input below
			if(empty($newPass) || empty($cNewPass))
				$msg = "Please enter all the fields!";
			else if($newPass !== $cNewPass)
				$msg = "Password doesn't match, please try again!";
			else// new pass match go ahead and update the database
			{
				require_once("scripts/password.php");
				
				if(UserModel::updatePassword($id,$newPass))  // call to updatePassword in UserModel to update the password based on ID, returns true if update success, false otherwise
					$msg = " Password reset successfully! <br><br>";
				else
					$msg = "Password reset failed <br><br>";	
				
				//***********************This block below check if the user has been activated if not send out another activating email******************************
				// *********************  In case they forgot their password immediately after register send out a new activation link ********************************
				$userQuery = QueryFactory::Build("select");	
				$userQuery->Select("activated")->From("users")->Where(["id","=",$id])->Limit();
				$resActivated = DatabaseManager::Query($userQuery)->Result()["activated"];
				if($resActivated === "0")// if account has not been activated send them activation link
				{ 
					$userQuery = QueryFactory::Build("select");				
					$userQuery->Select("email","created")->From("users")->Where(["id","=",$id])->Limit();
					$res = DatabaseManager::Query($userQuery);
					$res = $res->Result(); // get result from table
					$email = $res['email'];
					$activationLink = sha1($id.$res["email"].$res["created"]);// get the hash value for the link to send out
					Mailer::Send("$email","Activation Email","Your account is yet to be activated, please click on the link below to activate your account, http://$server/activation.php?id=$id&link=$activationLink"); 
					$msg =   "Your account has not been activated, please check your email for account activation";
				}//end if
			}//end else
		}else{
			$msg = "Invalid link, please try again!";
		}
		// ******************************** FORM ENFORCEMENT REGKEY !!! *************************************************8
	}
?>


<div class="background">
<?php if(!empty($msg)){?>
	<div><?='* '.$msg;?></div>
<?php } ?>
	<h1> Reset Password </h1>
	<form class="resetPassword" method="POST">

		<div class="labels"><label>New Password  </label></div> 
		<div class="labels"><label>(6 characters minimum)  </label></div> 
		<div class="inputFields"><input type="password" name="newPass" placeholder="" required></div> 
		
		<div class="labels"><label>Confirm New Password </label></div>
		<div class="labels"><label>(6 characters minimum)  </label></div> 
		<div class="inputFields"><input type="password" name="cNewPass" placeholder="" required></div> 
		
		<div class="inputFields"><button type="submit" name="reset" value="reset">reset</button></div>
	</form>
	</div>
</div>

		
<?php require_once"footer.php";?>