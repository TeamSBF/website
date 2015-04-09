

<?php
	if(isset($_POST['regKeyLogin']) && ($_POST['regKeyLogin'] == $_SESSION['regKeyLogin']))
	{
		$err_message = "";
		if(isset($_POST['emailLogin'], $_POST['passwordLogin']))
		{
			//scrub input
			$email = htmlspecialchars($_POST['emailLogin']);
			$passed_pwd = htmlspecialchars($_POST['passwordLogin']);
		
			//clear whitespace
			$email = trim($email);
			$passed_pwd = trim($passed_pwd);
		
			require_once("assets/password.php");
			//$options = array('cost' => 11);
	
			//$targetP = password_hash("test", PASSWORD_BCRYPT, $options);   //hardcode
			
			$result = UserModel::Login($email, $passed_pwd);    //to db
			
//			if($targetE == $email && password_verify($_POST['password'], $targetP))  //hardcode
			if($result)    //to db
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
	//$_POST['password'] = null;
	
	$_SESSION['regKeyLogin'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
?>
	
<!----------------------------------------form with bootstrap--------------------------->
	<div class="container-fluid">
		<div class="row">
			<div>
			<form class="form-signin" action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
				<input name="regKeyLogin" type="hidden" value = "<?php echo $_SESSION['regKeyLogin'];?>" />
				<?php if(1==2){?><h2 class="form-signin-heading">Please sign in</h2><?php } ?>
				
				<?php if(!empty($err_message)){ echo $err_message; }?>
					
				<label for="inputEmail" class="sr-only">Email address</label>
				<input name="emailLogin" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" <?php if(isset($_POST['emailLogin'])){echo 'value="'.$_POST['emailLogin'].'"'; }?> />
				<label for="inputPassword" class="sr-only">Password</label>
				<input name="passwordLogin" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" <?php if(isset($_POST['passwordLogin'])){echo 'value="'.$_POST['passwordLogin'].'"'; }?> />
							
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<a href>forgot your password?</a>
				<br>
				<a href>register account</a>
			</form>
			</div>
	  
		</div>
    </div>  
 