<pre>
<?php
require_once "config.php";

//QueryTests::All();
Mailer::Send("blah@a.a","sub","message");
$user = QueryFactory::Build("select");
$user->Select("id","email","created","activated")->From("users")->Where(["id","=",$_GET['id']])->Limit();
$res = DatabaseManager::Query($user);

$res = $res->Result();
if($res["activated"])
	die("already activated");

$blah = sha1($res["id"].$res["email"].$res["created"]);
echo $blah ."\n";
echo $_GET['link']."\n";
if($blah === $_GET['link'])
	echo "activate the account";
else
	echo "activation failed";
?>
</pre>