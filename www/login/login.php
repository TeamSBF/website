<?php

	if(isset($_POST['regKeyLogin']) && ($_POST['regKeyLogin'] === $_SESSION['regKeyLogin'])) {
        $err_message = "";
        if (isset($_POST['emailLogin'], $_POST['passwordLogin'])) {
            //scrub input
            $email = htmlspecialchars($_POST['emailLogin']);
            $passed_pwd = htmlspecialchars($_POST['passwordLogin']);

            //clear whitespace
            $email = trim($email);
            $passed_pwd = trim($passed_pwd);

            require_once("assets/password.php");

            $result = UserModel::Login($email, $passed_pwd);    //to db
            if ($result)    //to db
            {
                $_SESSION['id'] = $result;
				
                unset($_SESSION['regKeyLogin']);
                header("location: " . $_SERVER['PHP_SELF']);
            } else {
                $err_message = '<div class="alert alert-warning"> *failed to login* </div>';
            }
        }
    }
	unset($_POST['password']);
	
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
				<input name="emailLogin" type="email" id="inputEmail" class="form-control" placeholder="johndoe@example.net" required="required" <?php if(isset($_POST['emailLogin'])){echo 'value="'.$_POST['emailLogin'].'"'; }?> />
				<label for="inputPassword" class="sr-only">Password</label>
				<input name="passwordLogin" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" <?php if(isset($_POST['passwordLogin'])){echo 'value="'.$_POST['passwordLogin'].'"'; }?> />
							
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br>
				<a href>forgot your password?</a>
				<br>
				<a href = "../register.php">register account</a>
			</form>
			</div>
	  
		</div>
    </div>  
 