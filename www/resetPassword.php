<?php
	require_once "header.php";
	require_once "config.php";
	
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
		
		
		if($saltTime < time())
			echo "Reset password link has been expired, please get a new one from forgot password";
		else if($userIDHash === $_GET['link']){ // link is valid go ahead and reset the password
			$newPass = trim( $_POST['newPass']);
			$cNewPass = trim( $_POST['cNewPass']);
			
			if(empty($newPass) || empty($cNewPass))
				echo "Please enter all the fields!";
			else if($newPass !== $cNewPass)
				echo "Password doesn't match, please try again!";
			else{// new pass match go ahead and update the database
				require_once("scripts/password.php");
				
				if(UserModel::updatePassword($id,$newPass))
					echo " Password reset successfully! <br><br>";
				else
					echo "Password reset failed <br><br>";	
				
				//***********************This block below check if the user has been activated if not send out another activating email******************************
				$user = QueryFactory::Build("select");	
				$user->Select("activated")->From("users")->Where(["id","=",$id])->Limit();
				$resActivated = DatabaseManager::Query($user)->Result()["activated"];
				if($resActivated === "0"){ // if account has not been activated send them activation link
					$user = QueryFactory::Build("select");				
					$user->Select("email","created")->From("users")->Where(["id","=",$id])->Limit();
					$res = DatabaseManager::Query($user);
					$res = $res->Result(); // get result from table
					$email = $res['email'];
					$activationLink = sha1($id.$res["email"].$res["created"]);// get the hash value for the link to send out
					Mailer::Send("$email","Activation Email","Your account is yet to be activated, please click on the link below to activate your account, http://$server/activation.php?id=$id&link=$activationLink"); 
				}//end if
			}//end else
		}else{
			echo "Invalid link, please try again!";
		}
	
	}
?>

    <div class="background">
        <h1> Reset Password </h1>
		<form class="resetPassword" method="POST">

			<div class="labels"><label>New Password </label></div> 
            <div class="inputFields"><input type="password" name="newPass" placeholder=""></div> 
			
            <div class="labels"><label>Confirm New Password </label></div>
            <div class="inputFields"><input type="password" name="cNewPass" placeholder=""></div> 
            
            <div class="inputFields"><button type="submit" name="reset" value="reset">reset</button></div>
        </form>
        </div>
	</div>

		


	
<?php require_once"footer.php";?>