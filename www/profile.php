<?php
	require_once "header.php";
	//printr($_POST);
	if(isset($_POST['update'], $_POST['update']))// && $_POST['regKey'] === $_SESSION['regKey'])
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
			$select->Select("password")->From("users")->Where( ["id", "=", $_SESSION['id']] )->Limit(1);  // SELECT password from user where id = id
			$res = DatabaseManager::Query($select); // send to DBmanager
			//$res->Result()['password']; //get password from table
			
			if( password_verify($oldPass, $res->Result()['password']) ) //verify if the current password matches the password in the database
			{
				if(UserModel::updatePassword($_SESSION['id'], $newPass))
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
	//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	?>
    <section>
        <h1> Change Password </h1>
		<form class="changePassword" method="POST">
			<input type="hidden" name="regKey" value="">
			<label>Current password </label><br> 
            <input type="password" name="oldPass" placeholder=""> 
            <br>
            <br>
			<label>New Password </label> 
            <br>
            <input type="password" name="newPass" placeholder=""> 
            <br><br>
			<label>Confirm New Password </label>
            <br>
            <input type="password" name="cNewPass" placeholder=""> 
            <br><br>
            <button type="submit" name="update" value="update">update</button>
            <br>
        </form>
	</section>
	
	<section>
		<h1> something else </h1> <br>
		
	</section>
<?php require_once"footer.php";?>