<?php require_once "header.php";
	$msg = "";
	$id = Validator::instance()->sanitize("int", $_GET['id']);//get the ID from the link to prevent people from inserting their own ID
	// ****************************** Activate the user by ID ***********************************************************************
	$select = QueryFactory::Build("select");
	$select->Select("id","email","created","activated")->From("users")->Where(["id","=",$id])->Limit();
	$res = DatabaseManager::Query($select);
	$res = $res->Result();

	if($res["activated"] === 1)
			$msg = ["Your account is already activated!",1];
			
	$userActivationHash = sha1($res["id"].$res["email"].$res["created"]);// get user hash from database to compare against the link
	if($userActivationHash === $_GET['link'])
	{
		if( UserModel::updateElement($res["id"], "activated", "1") )  // if acctivation is a success
			$msg =  ["Account activation successful!",1];
		else
			$msg =  ["Your account is already activated!",0];
	}
	else
		$msg = ["Invalid link, please try again!",0];
	
?>


<div class="background">
	<h2><center> Activation </center></h2>
	<?php if(is_array($msg)) echo PartialParser::Parse("div",["content"=>"<h4>".$msg[0]."</h4>", "classes"=>($msg[1] === 1?"success":"error"), "style"=>"text-align:center;"]); ?>
</div>


<?php require_once "footer.php";?>