<pre>
<?php
$name = "userTable_".date('Y-m-d') . '.csv';
$myFile = fopen($name, "w");

$select = QueryFactory::Build("select");
// get all rows to users table
$select->Select("id", "email","created","password","pLevel" )->From("users");
        // Get the results from the query execution
$res = DatabaseManager::Query($select)->Result();

//iterate and write to file
foreach($res as $value)
{
	fputcsv($myFile, $value);
}
//Mailer::Send("$email","Activation Email","Please click on the link below to activate your account, http://localhost/activation.php?id=$id&link=$link");
//delete file??? 
?>
</pre>