<?php
	require_once "config.php";
	
	//if(isset($_POST['regKey']) && $_POST['regKey'] === $_SESSION['regKey'])
	if(isset($_POST['register']))
	{
		$email = trim($_POST['email']);
		$cEmail = trim($_POST['cEmail']); 
		$password = trim($_POST['password']);
		$cPassword = trim($_POST['cPassword']);
		$salt = "salt";
		print_r($_POST);
		
		
		
		if(empty($email) || empty($cEmail) || empty($password) || empty($cPassword))
			echo "all fields required";
		else if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
			echo "invalid email, try again";
		else if($email !== $cEmail)
			echo "Email doesn't match";
		else if($password !== $cPassword)
			echo "password doesn't match";
		else
		{
			
			if(!UserModel::Register($email,$password,$salt))
				echo "failed to register";
			else  //SEND to controller?
				echo "registration successful!";
			
			
		}
		
		
	}
	
	if(isset($_POST['login']))
	{
		header('Location: login.php');  
		//go to log in
	}
		
	
	
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>

<html>
	<head>
		<title> Register </title>

	</head>
	
	<body>
		<h1> Register </h1>
		
		<!--form action="</?=$_SERVER['PHP_SELF'];?>" method="POST">
			<input type="hidden" name="key" value="</?=$_SESSION['regKey'];?>" /-->
		<form method = "POST">
			<label>email address </label> <input type="text" name ="email" value="" >  <br> 
			<label>confirm email address </label> <input type="text" name ="cEmail" value="">	  <br>
			<label>password </label> <input type="password" name ="password" value=""> <br>
			<label>confirm password </label> <input type="password" name ="cPassword" value=""> <br>
			<input type="submit" name="register" value="Register">
			<input type="submit" name="login" value="Log in">
		</form>
	
	</body>
	
	
</html>
