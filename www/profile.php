<?php
	require_once "header.php";
	if(isset($_POST['update'], $_POST['update']))
	{
		$oldPass = trim($_POST['oldPass']);
		$newPass = trim($_POST['newPass']); 
		$cNewPass = trim($_POST['cNewPass']);
			
		
		if(empty($oldPass) || empty($newPass) || empty($cNewPass))
			echo "all fields required";
		else if($newPass !== $cNewPass) // check new pass match
			echo "new password doesn't match";
		else // update the password
		{
			require_once("assets/password.php");
			
			// this below is to grab the current password from the database
			$select = QueryFactory::Build("select");// build an empty select query
			$select->Select("password")->From("users")->Where( ["id", "=", $user->ID] )->Limit(1);  // SELECT password from user where id = id
			$res = DatabaseManager::Query($select); // send to DBmanager
			//$res->Result()['password']; //get password from table
			
			if( password_verify($oldPass, $res->Result()['password']) ) //verify if the current password matches the password in the database
			{
				if(UserModel::updatePassword($user->ID, $newPass))
					echo "Password changed successfully";
				else
					echo "Failed to change password";
				
				
			}
			else
			{
				echo "Current password doesn't match";
			}
		}
		
		
	}
	?>
    <div class="background">
        <h1> Change Password </h1>
		<form class="changePassword" method="POST">
			<div class="labels"><label>Current password </label></div>
            <div class="inputFields"><input type="password" name="oldPass" placeholder=""></div> 

			<div class="labels"><label>New Password </label></div> 
            <div class="inputFields"><input type="password" name="newPass" placeholder=""></div> 
			
            <div class="labels"><label>Confirm New Password </label></div>
            <div class="inputFields"><input type="password" name="cNewPass" placeholder=""></div> 
            
            <div class="inputFields"><button type="submit" name="update" value="update">update</button></div>
        </form>
        </div>
	</div>

		

		
<?php require_once"footer.php";?>