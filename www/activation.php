<?php
	require_once "header.php";
	require_once "config.php";
	
	$id = Validator::instance()->sanitize("int", $_GET['id']);//get the ID from the link to prevent people from inserting their own ID
	$select = QueryFactory::Build("select");
	$select->Select("id","email","created","activated")->From("users")->Where(["id","=",$id])->Limit();
	$res = DatabaseManager::Query($select);
	$res = $res->Result();

	if($res["activated"] === 1)
			die("Your account is already activated!");
	
	$userActivationHash = sha1($res["id"].$res["email"].$res["created"]);// get user hash from database to compare against the link
	if($userActivationHash === $_GET['link'])
	{
		if( UserModel::updateElement($res["id"], "activated", "1") )  // if acctivation is a success
			echo "Account activation successful!";
		else
			echo "Your account is already activated!";
	}
	else
		echo "Invalid link, try again!";
		
	require_once "footer.php";
?>