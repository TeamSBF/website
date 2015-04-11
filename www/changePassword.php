<?php
	require_once "config.php";
	
	
	//if(isset($_POST['regKey']) && $_POST['regKey'] === $_SESSION['regKey'])
	if(isset($_POST['submit']))
	{
		$oldPass = trim($_POST['oldPass']);
		$newPass = trim($_POST['newPass']); 
		$cNewPass = trim($_POST['cNewPass']);
		
		if(empty($oldPass) || empty($newPass) || empty($cNewPass))
			echo "all fields required";
		else if($newPass !== $cNewPass)
			echo "new password doesn't match!";
		else
		{
			
			echo "send to controller???";
			//SEND to controller?
			
		}
		
		
	}
		
	
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>

<html>
	<head>
		<title> Change Password </title>

	</head>
	
	<body>
		<h1> Change Password </h1>
		
		<!--<form action="</?=$_SERVER['PHP_SELF'];?>" method="POST">-->
		<form method = "POST">
			<label>current password </label> <input type="password" name ="oldPass" value="" >  <br> 
			<label>new password </label> <input type="password" name ="newPass" value="">	  <br>
			<label>confirm new password </label> <input type="password" name ="cNewPass" value=""> <br>
			<input type="submit" name="submit" value="submit">
		</form>
	
	</body>
	
	
</html>


