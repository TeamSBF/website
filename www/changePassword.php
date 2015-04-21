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
			
			if(UserModel::Exists("email", $email))
				echo "Failed to register, email already exists, please use a different email"; 
			else if(UserModel::Register($email,$password,$salt))
				echo "Registration Successful!";
			else
				echo "Failed to register";
			
			
		}
		
		
	}
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>
    <section>
        <h1> Change Password </h1>
		<form class="changePassword" method="POST">
			<input type="hidden" name="regKey" value="">
			<label>E-mail Address </label><br> 
            <input type="text" name="email" placeholder="johndoe@example.net"> 
            <br>
            <br>
			<label>Password </label> 
            <br>
            <input type="password" name="password" placeholder="Password"> 
            <br><br>
			<label>Confirm Password </label>
            <br>
            <input type="password" name="cPassword" placeholder="Confirm Password"> 
            <br><br>
            <button type="submit" name="update" value="update">update</button>
            <br>
        </form>
	</section>
	<section>
		<h1> something else ... </h1>
	</section>
<?php require_once"footer.php";?>