<?php
	require_once "header.php";
	if(isset($_POST['retrieve']) )
	{
		$email = trim($_POST['email']);
		$server = $_SERVER['SERVER_NAME'];
		
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) // check the email entered against php built in email validator
			echo "Email is invalid, please try again";
		else if(!UserModel::Exists("email", $email))
			echo "Email doesn't exist in database, please try again";
		else{// email exists go ahead send a reset password link and activation link
		
			// grab salt time to check if the link has been expired
			$user = QueryFactory::Build("select");				
			$user->Select("id","salt", "salt_time")->From("users")->Where(["email","=",$email])->Limit();
			$res = DatabaseManager::Query($user)->Result();
			$id = $res["id"];
			$salt = $res["salt"];
			$saltTime = $res["salt_time"];
			
			//if current time is greater then last salt change
			// *************** BIG NOTE!!! change this update to 1 day before deploy!!!
			if($saltTime < time())
			{
				// READ FROM SETTINGS TABLE TO GRAB THE SALT_TIME AND PLUG IT IN BELOW 
				
				$select = QueryFactory::Build("select");
				$select->Select("value")->From("settings")->Where( ["name", "=", "forgotpassword"] )->Limit();
				$lifeTime = DatabaseManager:: Query($select)->Result()['value'];
				//print_r($select->Query(true));
				//update salt and salt_time
				$salt = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)); // this will generate a new salt every time if exceed 24 hrs
				$update = QueryFactory::Build("update"); 
				$update->Table("users")->Where( ["id", "=", $id] )->Set(["salt",  $salt],["salt_time", strtotime("$lifeTime")]); //update the salt and add a certain time to last salt CHANGE TO VARIABLE
				$resUpdate = DatabaseManager::Query($update); // execute the query
				
				$link = sha1($id.$salt);
			}else{
				$link = sha1($id.$salt);
			}
			
			Mailer::Send("$email","Reset Password","Please click on the link below to change your password, http://$server/resetPassword.php?id=$id&link=$link");
		}
		
	}
?>


<div class="background">
	<h1> Forgot Password </h1>
	<form class="forgotPassword" method="POST">
		<div class="labels"><label>Email address </label></div>
		<div class="inputFields"><input type="text" name="email" placeholder=""></div> 
		<div class="inputFields"><button type="submit" name="retrieve" value="retrieve">Retreive</button></div>
	</form>
	</div>
</div>

	
<?php require_once"footer.php";?>