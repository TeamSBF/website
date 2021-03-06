<?php require_once"header.php";
$msg = "";
if(isset($_POST['regKeyLogin']) && ($_POST['regKeyLogin'] === $session->get('regKeyLogin'))) {
    $err_message = "";
    if (isset($_POST['emailLogin'], $_POST['passwordLogin'])) {
        //scrub input
        $email = htmlspecialchars($_POST['emailLogin']);
        $passed_pwd = htmlspecialchars($_POST['passwordLogin']);

        //clear whitespace
        $email = trim($email);
        $passed_pwd = trim($passed_pwd);

        $result = UserModel::Login($email, $passed_pwd);    //to db
		//grab activated to check against
		$user = QueryFactory::Build("select");	
		$user->Select("activated")->From("users")->Where(["email","=",$email])->Limit();
		$res = DatabaseManager::Query($user);
		$activated = $res->Result()['activated']; // get result from table
		
        if ($result && $activated === "1")    //to db (result must be valid and must be activated to be able to log in)
        {
            $session->refresh();
            $session->put('user', $result);
            header("location: index.php");
        } else {
            $msg = ["Invalid username/password",0];
        }
    }
}

$session->put('regKeyLogin', bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)));
?>
  	<div class="container">
  		<div class="row">
			<div class ="col-sm-4">
                <div class="container-fluid">
                    <div class="row">
                        <div>
							<?php if(is_array($msg)) echo PartialParser::Parse("div",["content"=>$msg[0], "classes"=>($msg[1] === 1?"success":"error")]);?>
                            <form class="form-signin" action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                                <input name="regKeyLogin" type="hidden" value = "<?php echo $_SESSION['regKeyLogin'];?>" />
                                <?php if(1==2){?><h2 class="form-signin-heading">Please sign in</h2><?php } ?>

                                <?php if(!empty($err_message)){ echo $err_message; }?>

                                <label for="inputEmail" class="sr-only">Email address</label>
                                <input name="emailLogin" type="email" id="inputEmail" class="form-control" placeholder="johndoe@example.net" required="required" <?php if(isset($_POST['emailLogin'])){echo 'value="'.$_POST['emailLogin'].'"'; }?> />
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input name="passwordLogin" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" <?php if(isset($_POST['passwordLogin'])){echo 'value="'.$_POST['passwordLogin'].'"'; }?> />

                                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br>
                                <a href="forgotPassword.php">Forgot your password?</a>
                                <br>
                                <a href="register.php">Register account</a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
	</div>
</div>