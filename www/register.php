<?php
	require_once "header.php";
	//printr($_POST);
	
	if(isset($_POST['regKey'], $_POST['register']))// && $_POST['regKey'] === $_SESSION['regKey'])
	{
		//********************* GET ALL THE FILEDS FROM THE FORM **************************************
		$email = trim($_POST['email']);
		$cEmail = trim($_POST['cEmail']); 
		$password = trim($_POST['password']);
		$cPassword = trim($_POST['cPassword']);
		$server = $_SERVER['SERVER_NAME'];
		$recaptcha=$_POST['g-recaptcha-response']; //get recaptcha (google api)
		
		if(empty($email) || empty($cEmail) || empty($password) || empty($cPassword) || empty($recaptcha))
			echo "all fields required";
		else if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) // check the email entered against php built in email validator
			echo "invalid email, try again";
		else if($email !== $cEmail)
			echo "Email doesn't match";
		else if($password !== $cPassword)
			echo "password doesn't match";
		else{
			if(UserModel::Exists("email", $email))
				echo "Failed to register, email already exists, please use a different email"; 
			else{
				// ************************************************* this block is google's recaptcha stuff *************************************************************************
				//*********************************************** THIS IS FROM GOOGLE RECAPTCHA API ***********************************************************************
				$secret = "6LejtgYTAAAAAMlSC70hXViKkntfBVU2PBdICylx";  // this is a secret code for reCaptcha connection
				$ip = gethostbyname($_SERVER['SERVER_NAME']); // this is how you grab end user's ip
				$captcha = $_POST['g-recaptcha-response'];
				$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
				$captchaResult = json_decode($response, true);
				
				//******************************************************************************************************************************************************************************
				if($captchaResult['success']){// if pass recaptcha go ahead and register
					$id =  UserModel::Register($email,$password); // return boolean if registration success or not
					if($id){
						//*****************   SEND ACTIVATION EMAIL ********************************
						$user = QueryFactory::Build("select");				
						$user->Select("email","created")->From("users")->Where(["id","=",$id])->Limit();
						$res = DatabaseManager::Query($user);
						$res = $res->Result(); // get result from table
						
						$link = sha1($id.$res["email"].$res["created"]);// get the hash value for the link to send out
						
						Mailer::Send("$email","Activation Email","Please click on the link below to activate your account, http://$server/activation.php?id=$id&link=$link"); 
						echo "<br><br>Check your email for account activation";
					}
					else
						echo "You are not a human, registration denied! <br>";
				
				}
			}
		}	
	}
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	//^^^^^^^^^^^^^^^^^^^^ ADD THIS IN BEFORE DEPLOY TO MAKE SURE USER USE OUR FORM !!!! **********************************************************************
	
?>
<div class="background">
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
		<label>Password </label> 
		<br>
		<input type="password" name="password" placeholder="Password" required> 
		<br><br>
		<label>Confirm Password </label>
		<br>
		<input type="password" name="cPassword" placeholder="Confirm Password" required> 
		<br><br>
		<div class="g-recaptcha" data-sitekey="6LejtgYTAAAAAITL_F2_L0NbPWtcEk35Cn7-O98W" data-theme="light"></div> <!--recaptcha  stuff (from google api)-->
		<button type="submit" name="register" value="Register">Register</button>
		<br>
		
		
	</form>
	<script src="https://www.google.com/recaptcha/api.js?fallback=false" async defer></script>  <!--recaptcha js (from google api) -->
	
</div>
<?php require_once"footer.php";?>