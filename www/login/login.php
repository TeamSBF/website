

<?php
	if(isset($_POST['regKey']) && ($_POST['regKey'] === $_SESSION['regKey']))
	{
		$err_message;
		if(isset($_POST['email'], $_POST['password']))
		{
			//scrub input
			$email = htmlspecialchars($_POST['email']);
			$passed_pwd = htmlspecialchars($_POST['password']);
		
			//clear whitespace
			$email = trim($email);
			$passed_pwd = trim($passed_pwd);
		
			require_once("assets/password.php");
			$options = array('cost' => 11);
	
			$result=1; //hardcode
			$targetE="test@mail.com";  //hardcode
			$targetP = password_hash("test", PASSWORD_BCRYPT, $options);   //hardcode
			
//			$result = UserModel::Login($email,$passed_pwd);    //to db
			
			if($targetE == $email && password_verify($_POST['password'], $targetP))  //hardcode
//			if($result!= false)    //to db
			{
				$_SESSION['user_id']=$result;
				header("location: ".$_SERVER['PHP_SELF'] ) ;
			}
			else
			{
				$err_message= '<div class="alert alert-warning"> *failed to login* </div>';
			}
		}	
	}
	
	$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
?>
	
<!----------------------------------------form with bootstrap--------------------------->
	<div class="container-fluid">
		<div class="row">
			<div>
			<form class="form-signin" method="POST">
				<input name="regKey" type="hidden" value = <?php echo $_SESSION['regKey'];?> >
				<h2 class="form-signin-heading">Please sign in</h2>
				
				<?php echo $err_message; ?>
					
				<label for="inputEmail" class="sr-only">Email address</label>
				<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
							
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<a href>forgot your password?</a>
				<br>
				<a href>register account</a>
			</form>
			</div>
	  
		</div>
    </div>  
 