<?php
	require_once "header.php";
	$msg = "";
	// When the user press RETRIEVE
	if(isset($_POST['retrieve']) )
	{
		//********************* get the email from the form **************************************
		$email = trim(strip_tags($_POST['email']));
		$server = $_SERVER['SERVER_NAME'];
		
		//***************************** this block below is where we validate input from user *************************************************************************
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) // check the email entered against php built in email validator
			$msg = ["Invalid Email address, please try again",0];
		else if(!UserModel::Exists("email", $email))
			$msg = ["Email doesn't exist in our database, please try again",0];
		else// email exists go ahead send a reset password link and activation link
		{
			// grab salt time ( When the link was created ) to check if the link has been expired
			$userQuery = QueryFactory::Build("select");				
			$userQuery->Select("id","salt", "salt_time")->From("users")->Where(["email","=",$email])->Limit();
			$res = DatabaseManager::Query($userQuery)->Result();
			$id = $res["id"];
			$salt = $res["salt"];
			$saltTime = $res["salt_time"];
			
			//if current time is greater then last salt ( When the link was created ) 
			// *************** BIG NOTE!!! change this update to 1 day before deploy!!! ( IN SETTINGS TABLE!!!! )
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
			$msg = ["Please check your email for reset password link",1];
		}
		// ******************************** FORM ENFORCEMENT REGKEY !!! *************************************************8
	}
?>


<div class="background">
	<?php if(is_array($msg)) echo PartialParser::Parse("div",["content"=>$msg[0], "classes"=>($msg[1] === 1?"success":"error")]); ?>
	<h1> Forgot Password </h1>
	<form class="forgotPassword" method="POST">
		<div class="labels"><label>Email address</label></div>
		<div class="inputFields"><input type="text" name="email" placeholder="johndoe@example.net" required></div> 
		<div class="inputFields"><button type="submit" name="retrieve" value="retrieve">Retreive</button></div>
	</form>
	</div>
</div>

	
<?php require_once"footer.php";?>