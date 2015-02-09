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
		#error{
			<font color = "red">;
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
		
		if($controller->authenticateUser($loginInfo))
		{
			header("location: members.php");
		}else{
			$error = true;
		} 

	}
?>
	<div id="mainLogin">
			<form action="<?=($_SERVER['PHP_SELF']);?>" method="post">
		
			<fieldset>
			<legend> Login Page </legend>
			
				<div id ="error">
					<?php
						if(isset($error))
							echo '<p><font color="red">*Username/Password is incorrect*</font></p>';
					?>
				</div>

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