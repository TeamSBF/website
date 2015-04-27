<?php
	require_once "header.php";
	//printr($_POST);
	if(isset($_POST['regKey'], $_POST['forgot']))// && $_POST['regKey'] === $_SESSION['regKey'])
	{
		$email = trim($_POST['email']);
		
		//print_r($_POST);
		
		
		
		if(empty($email))
			echo "email is required";
		else if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
			echo "invalid email, try again";
		else// input is valid check against  db if email actually exist and do something
		{
			if(UserModel::Exists("email",$email))// send an email???
				echo "email exists";
			else
				echo "Email not exists in database, please enter a different email";
			
		}
		
		
	}
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>
    <div class="background">
        <h1> Forgot Password </h1>
		<form class="forgotPassword" method="POST" >
			<input type="hidden" name="regKey" value="">
            <div class="labels"><label>E-mail Address </label></div> 
            <div class="inputFields"><input type="text" name="email" placeholder="johndoe@example.net"></div>  
            <div class="inputFields"><button type="submit" name="forgot" value="forgot">Submit</button></div>
        </form>
    </div>

<?php require_once"footer.php";?>

