<?php
	require_once "header.php";
	
	// if the user press REGISTER
	if(isset($_POST['regKey'], $_POST['register']))// && $_POST['regKey'] === $_SESSION['regKey'])
	{
		//********************* GET ALL THE FILEDS FROM THE FORM **************************************
		$email = trim(strip_tags($_POST['email']));
		$cEmail = trim(strip_tags($_POST['cEmail']));
		$password = trim(strip_tags($_POST['password']));
		$cPassword = trim(strip_tags($_POST['cPassword']));
		$server = $_SERVER['SERVER_NAME'];
		$recaptcha = $_POST['g-recaptcha-response']; //get recaptcha (google api)
		$msg = "";
		
		//***************************** this block below is where we validate input from user *************************************************************************
		if(empty($email) || empty($cEmail) || empty($password) || empty($cPassword) || empty($recaptcha))
			$msg =   "All fields required";
		else if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))// check the email entered against built in PHP email validator
			$msg =  "Invalid Email address, please try again!";
		else if($email !== $cEmail)
			$msg =   "Email doesn't match, please try again";
		else if($password !== $cPassword)
			$msg =   "Password doesn't match, please try again";
		else
		{ //Incoming data is good, go ahead and try to register
			// First case if the email user enter an existing email, register fails
			if(UserModel::Exists("email", $email)) 
				$msg =   "Failed to register, email already exists, please use a different email"; 
			else
			{
				// ************************************************* this block is google's recaptcha *************************************************************************
				//*********************************************** THIS IS FROM GOOGLE RECAPTCHA API ***********************************************************************
				$secret = "6LejtgYTAAAAAMlSC70hXViKkntfBVU2PBdICylx";  // this is a secret code for reCaptcha connection
				$ip = gethostbyname($_SERVER['SERVER_NAME']); // this is how you grab end user's ip
				$captcha = $_POST['g-recaptcha-response'];
				$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
				$captchaResult = json_decode($response, true);
				
				//******************************************************************************************************************************************************************************
				if($captchaResult['success'])// if pass reCaptcha go ahead and register
				{
					$id =  UserModel::Register($email,$password); // Call to Register function in UserModel, returns true if register is a success
					if($id)
					{
						//*****************   SEND ACTIVATION EMAIL ********************************
						$userQuery = QueryFactory::Build("select");				
						$userQuery->Select("email","created")->From("users")->Where(["id","=",$id])->Limit();
						$res = DatabaseManager::Query($userQuery);
						$res = $res->Result(); // get result from table
						
						$link = sha1($id.$res["email"].$res["created"]);// get the hash value for the link to send out
						
						Mailer::Send("$email","Activation Email","Please click on the link below to activate your account, http://$server/activation.php?id=$id&link=$link"); 
						$msg =   "Registration successful, please check your email for account activation";
					}
				}
				else // Failed reCaptcha, registration denied
				{
					$msg =   "You are not a human, registration denied! <br>";
				}
			}
		}	
	}
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	//^^^^^^^^^^^^^^^^^^^^ ADD THIS IN BEFORE DEPLOY TO MAKE SURE USER USE OUR FORM !!!! **********************************************************************	
?>


<div class="background">
	<?php if(!empty($msg)){?>
		<div><?='* '.$msg;?></div>
	<?php } ?>
	<h1> Register </h1>
	<form class="register" method="POST" >
		<input type="hidden" name="regKey" value="">
		<label>E-mail Address </label><br> 
		<input type="text" name="email" placeholder="johndoe@example.net" oncut="return false;" required> <!--   onpaste="return false;"  ONCOPY, ONCUT, ONSHIT << ADD THIS ATTRIBUTE IN BEFORE DEPLOY!!--> 
		<br> 
		<br>
		<label>Confirm E-mail Address </label><br>
		<input type="text" name="cEmail" placeholder="johndoe@example.net" required>	  
		<br>
		<br>
		<label>Password (6 characters minimum) </label> 
		<br>
		<input type="password" name="password" placeholder="Password" required> 
		<br><br>
		<label>Confirm Password (6 characters minimum)</label>
		<br>
		<input type="password" name="cPassword" placeholder="Confirm Password" required> 
		<br><br>
		<div class="g-recaptcha" data-sitekey="6LejtgYTAAAAAITL_F2_L0NbPWtcEk35Cn7-O98W" data-theme="light"></div> <!--reCaptcha  (from Google API)-->
		<button type="submit" name="register" value="Register">Register</button>
		<br>	
	</form>
	<script src="https://www.google.com/recaptcha/api.js?fallback=false" async defer></script>  <!--reCaptcha  (from Google API)-->
</div>


<?php require_once"footer.php";?>