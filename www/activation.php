<?php
	require_once "header.php";
	require_once "config.php";
	
	
	$select = QueryFactory::Build("select");
	$select->Select("id","email","created","activated")->From("users")->Where(["id","=",$_GET['id']])->Limit();
	$res = DatabaseManager::Query($select);
	$res = $res->Result();
	
	$userActivationHash = sha1($res["id"].$res["email"].$res["created"]);// get user hash to compare against the link

	if($userActivationHash === $_GET['link'])
	{
		echo "herrrrrrrrrrrrrreeeee";
		if( UserModel::updateElement("39", "activated", "1") )  // Cant grab the current ID but hard code version works for now
			echo "Account activation successful!";
		else if(UserModel::Exists("activated", "1"))
			die("Your account is already activated!");
		else
			echo "Account activation failed!";
	}
	else
		echo "Invalid link, try again!";
		
	require_once "footer.php";
?>