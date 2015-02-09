<!DOCTYPE html>
<html>
<head>
		<style>
		#mainLogin
		{
			background-color: lightblue;
			width: 200px;
			padding: 25px;
			border: 25px solid gray;
			margin: 25px;
		}
		
		.loginLabel
		{
			font-weight:bold;
		}

		space{
		background-color: darkblue;
		width: 50px;
		padding: 25px;
		border: 25px dash black;
		margin: 25px;
		
		}	
		</style>
</head>
<body>
<?php
	require(__DIR__.'\..\Controller\SbfController.php');

	if(!empty($_POST["user"]) and !empty($_POST["pass"]))
	{
		//scrub input
		$passed_user = htmlspecialchars($_POST["user"]);
		$passed_pwd = htmlspecialchars($_POST["pass"]);

		//clear whitespace
		$passed_user = trim($passed_user);
		$passed_pwd = trim($passed_pwd);

		//make object
		$loginInfo = array("email"=>$passed_user, "password"=>$passed_pwd);
		//pass to db manager and get results
		$controller = new SbfController();
		$controller->authenticateUser($loginInfo);

		/*
		//compare reults
		$result_name = "mason";
		$result_email = "email@email.email";
		$result_password = "password";

		if(($passed_user==$result_name or $passed_user == $result_email) and $passed_pwd == $result_password)
		{
			header("location: members.php");
		}else{
			echo 'failed';
		} */

	}
?>
	<div id="mainLogin">
			<form action="<?=($_SERVER['PHP_SELF']);?>" method="post">
		
			<fieldset>
			<legend> Login Page </legend>

				<div id ="userNameInput">
					<label for="user" class ="loginLabel">
						User name:
					</label>
					<input type="text" name="user" required>
				</div>
				
				<div id = "passwordInput">
					<label for = "password" class ="loginLabel">
						Password:
					</label>
					<input type="password" name="pass" required>
				</div>
				
				<div class = "submitButton">
					<input type="image" src="../images/submitButton.png" value="" >
				</div>
				
				<div id = "recovery">
					<a href="recovery.php">forgot your password or user name?</a>
				</div>
				<div id = "register">
					<a href="Registration.php">register an account</a>
				
			</fieldset>
			</form>
	</div>

</body>
</html>