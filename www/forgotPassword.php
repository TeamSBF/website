<?php
	require_once "header.php";
	if(isset($_POST['retrieve']) )
	{
		$email = trim($_POST['email']);
		
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
			echo "Email is invalid, please try again";
		else if(!UserModel::Exists("email", $email))
			echo "Email doesn't exist in database, please try again";
		else{// email exists go ahead send a reset password link and activation link
			$user = QueryFactory::Build("select");				
			$user->Select("id")->From("users")->Where(["email","=",$email])->Limit();
			$res = DatabaseManager::Query($user)->Result();
			$id = $res["id"];
			$link = sha1($id);
			echo "id is: $id";
			Mailer::Send("$email","Reset Password","Please click on the link below to change your password, http://localhost/resetPassword.php?id=$id&link=$link"); 
		}
	}
?>


    <div class="background">
        <h1> Forgot Password </h1>
		<form class="forgotPassword" method="POST">
			<div class="labels"><label>Email address </label></div>
            <div class="inputFields"><input type="text" name="email" placeholder=""></div> 
            <div class="inputFields"><button type="submit" name="retrieve" value="retrieve">Retreive</button></div>
        </form>
        </div>
	</div>

	
<?php require_once"footer.php";?>