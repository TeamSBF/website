<?php
	require_once "header.php";
	if(isset($_POST['retrieve']) )
	{
		$email = trim($_POST['email']);
		
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
			echo "Email is invalid, please try again";
		else if(!UserModel::Exists("email", $email))
			echo "Email doesn't exist in database, please try again";
		else{// email exists go ahead and send out temp password
			require_once("scripts/password.php");
			$user = QueryFactory::Build("select");	
			$user->Select("password", "id")->From("users")->Where(["email","=",$email])->Limit();
			$res = DatabaseManager::Query($user);
			$res = $res->Result(); // get result from table
			$password = sha1($res["password"]);
			$id = $res["id"];
			
			//print_r("password is : $password <br><br>");
			//print_r("id is: $id <br><br>");

			$update = QueryFactory::Build("update"); //new update query
			$update->Table("users")->Where( ["id", "=", $id] )->Set(["password",  UserModel::hashPass($password)]); //update the query
			$res1 = DatabaseManager::Query($update); // execute the query
			if($res1->RowCount() == 1)
				Mailer::Send("$email","Retrieve password", " Your temporary password  is: $password , please log in and update your password");
			else
				echo "Update table failed <br>";	
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