<?php
	require_once "header.php";
	require_once "config.php";
	
	if(isset($_POST['reset']) )
	{
		$id = Validator::instance()->sanitize("int", $_GET['id']);//get the ID to prevent people from inserting their own ID
		$select = QueryFactory::Build("select");
		$select->Select("id")->From("users")->Where(["id","=",$id])->Limit();
		$res = DatabaseManager::Query($select)->Result();
		
		$userIDHash = sha1($res["id"]);
		if($userIDHash === $_GET['link']){ // link is valid go ahead and reset the password
			$newPass = trim( $_POST['newPass']);
			$cNewPass = trim( $_POST['cNewPass']);
			
			if(empty($newPass) || empty($cNewPass))
				echo "Please enter all the fields!";
			else if($newPass !== $cNewPass)
				echo "Password doesn't match, please try again!";
			else{// new pass match go ahead and update the database
				echo "here";
				require_once("scripts/password.php");
				
				//********************this block below does all the update password in the database*******************************************************************
				$update = QueryFactory::Build("update"); //new update query
				$update->Table("users")->Where( ["id", "=", $id] )->Set(["password",  UserModel::hashPass($newPass)]); //update the query
				$resUpdate = DatabaseManager::Query($update); // execute the query
				if($resUpdate->RowCount() == 1)
					echo " Password reset successfully! <br><br>";
				else
					echo "Password reset failed <br><br>";	
				//***********************This block below check if the user has been activated if not send out another activating email******************************
				$user = QueryFactory::Build("select");	
				$user->Select("activated")->From("users")->Where(["id","=",$id])->Limit();
				$resActivated = DatabaseManager::Query($user)->Result()["activated"];
				if($resActivated === "0"){ // if account has not been activated send them activation link
					$user = QueryFactory::Build("select");				
					$user->Select("email","created", "password")->From("users")->Where(["id","=",$id])->Limit();
					$res = DatabaseManager::Query($user);
					$res = $res->Result(); // get result from table
					$email = $res['email'];
					$activationLink = sha1($id.$res["email"].$res["created"].$res["password"]);// get the hash value for the link to send out
					Mailer::Send("$email","Activation Email","Please click on the link below to activate your account, http://localhost/activation.php?id=$id&link=$activationLink"); 
				}
			}	
		}else{
			echo "Invalid link, please try again!";
		}
	
	}
?>

    <div class="background">
        <h1> Reset Password </h1>
		<form class="resetPassword" method="POST">

			<div class="labels"><label>New Password </label></div> 
            <div class="inputFields"><input type="password" name="newPass" placeholder=""></div> 
			
            <div class="labels"><label>Confirm New Password </label></div>
            <div class="inputFields"><input type="password" name="cNewPass" placeholder=""></div> 
            
            <div class="inputFields"><button type="submit" name="reset" value="reset">reset</button></div>
        </form>
        </div>
	</div>

		


	
<?php require_once"footer.php";?>