<?php
	require_once "header.php";
	
	//printr($_POST);
	if(isset($_POST['regKey'], $_POST['register']))// && $_POST['regKey'] === $_SESSION['regKey'])
	{
		$email = trim($_POST['email']);
		$cEmail = trim($_POST['cEmail']); 
		$password = trim($_POST['password']);
		$cPassword = trim($_POST['cPassword']);
		$salt = "salt";
		//print_r($_POST);
		
		
		
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
			
			if(UserModel::Register($email,$password,$salt))
				echo "registration successful!";
			else  //SEND to controller?
				echo "failed to register";
			
			
		}
		
		
	}
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>
		<h1> Register </h1>
		<form method = "POST">
			<input type="hidden" name="regKey" value="<?=$_SESSION['regKey'];?>" />
			<label>email address </label> <input type="text" name ="email" <?php if(isset($_POST['email'])){echo 'value="'.$_POST['email'].'"'; }?> />  <br> 
			<label>confirm email address </label> <input type="text" name ="cEmail" <?php if(isset($_POST['email'])){echo 'value="'.$_POST['email'].'"'; }?> />	  <br>
			<label>password </label> <input type="password" name ="password" <?php if(isset($_POST['password'])){echo 'value="'.$_POST['password'].'"'; }?>> <br>
			<label>confirm password </label> <input type="password" name ="cPassword" <?php if(isset($_POST['cPassword'])){echo 'value="'.$_POST['cPassword'].'"'; }?>> <br>
			<input type="submit" name="register" value="Register">
		</form>
<?php require_once"footer.php";?>