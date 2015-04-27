<pre>
<?php
require_once "config.php";

//QueryTests::All();
/*
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
//*/

/*
$select = QueryFactory::Build("select")->Select("title","content","created","viewby")->From("articles");
$info = DatabaseManager::Query($select);
$articles = $info->Result();
// Result returns the result directly if there is only one result
// This compensates for that by wrapping the single result in an array, like multiple articles would be
// This allows for a simpler code base
if($info->RowCount() < 2)
    $articles = [$articles];

echo PartialParser::Parse("article", $articles[0]);
//*/
$insert = QueryFactory::Build("insert")->Into("parq_form")->Set(["userID", "2"]);
$insert->Set(["q11","No"],["q12","No"],["q13","No"],["q14","No"],["q15","No"],["q16","No"],["q17","No"]);
$insert->Set(["q31","2015-04-20"],["q32","sami"],["q33",""]);
printr($insert->Query(true));
echo "INSERT INTO `parq_form` (`userID`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q31`, `q32`, `q33`) VALUES(2, 'No', 'No', 'No', 'No', 'No', 'No', 'No', '2015-04-20', 'sami', '')";
$res = DatabaseManager::Query($insert);
echo $res->RowCount();
?>
</pre>