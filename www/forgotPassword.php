<?php
	require_once "header.php";
	if(isset($_POST['retrieve']) )
	{
		$email = trim($_POST['email']);
		
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
			echo "Email is invalid, please try again";
		else if(!UserModel::Exists("email", $email))
			echo "Email doesn't exist in database, please try again";
		else{
			$user = QueryFactory::Build("select");	
			$user->Select("password")->From("users")->Where(["email","=",$email])->Limit();
			$res = DatabaseManager::Query($user);
			$res = $res->Result(); // get result from table
			$password = $res["password"];
			$passwordHash = sha1($password);
			
			$newPass = UserModel::hashPass($newPass); // hash the incoming password
			$update = QueryFactory::Build("update"); //new update query
			$update->Table("users")->Where( ["password", "=", $password] )->Set(["password",  $passwordHash]); //update the query
			$res1 = DatabaseManager::Query($update); // execute the query
			
			Mailer::Send("$email","Retrieve password", " Your temporary password  is: $passwordHash , please log in and update your password");
			print_r($password);

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