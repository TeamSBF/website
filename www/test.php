<pre>
<?php
require_once "config.php";
/*
require_once "Queries/QueryInfo.php";
require_once "Queries/QueryFactory.php";
require_once "Managers/DatabaseManager.php";
require_once "Queries/CreateTableQuery.php";
require_once "Queries/SelectQuery.php";
require_once "Queries/InsertQuery.php";
require_once "Queries/UpdateQuery.php";
*/

/*
$tableName = "users";
if(!DatabaseManager::TableExists($tableName)) {
    $user = include("sql/" . $tableName . ".php");
    try {


		print_r(DatabaseManager::Query($user));
        echo "Added table '$tableName'<br>";
    } catch (PDOException $e) {
        echo "Adding table '$tableName' failed: " . $e->getMessage();
    }
}
//*/

/*
echo "\n\n=============== SelectQuery Checks ===============\n";
$select = new SelectQuery();
$select->Select(["id","email","activated"])->Table("users")->Where("id","=","1","and")->Where("email","=","email");
//print_r($select->Query());
testQuery($select);
//*/

/*
echo "\n\n=============== InsertQuery Checks ===============\n";
$insert = new InsertQuery();
$insert->Table("users")->Set("id","NULL")->Set("email","blah12@blah.blah")->Set("password","asdasf");
$insert->Set("salt","erbver")->Set("created","UNIX_TIMESTAMP()")->Set("activated","0");
//print_r($insert->Query());
testQuery($insert);
//*/

/*
echo "\n\n=============== UpdateQuery Checks ===============\n";
$update = new UpdateQuery();
$update->Table("users")->Set("email","erbveredfvev")->Set("created","UNIX_TIMESTAMP()")->Set("salt","blahblah1")->Where("id","=","3");
//print_r($update->Query());
testQuery($update);
//*/

/*
echo "\n\n=============== DeleteQuery Checks ===============\n";
$delete = new DeleteQuery();
$delete->From("users")->Where("id","=","4");
//print_r($delete->Query());
testQuery($delete);
//*/

function testQuery($query)
{
    $qinfo = DatabaseManager::Query($query);
    echo "\nResults from " . $query->Query()[0] . "\n";
    print_r($qinfo->Result());
    echo"\nRows Affected: " . $qinfo->RowCount();
}

/*
echo "\n\n=============== Register Checks ===============\n";
echo "successful user registration: ". (UserModel::Register("email","blah","asd")?"true":"false") . "\n";
echo "failed user registration: ". (UserModel::Register("email","blah","asd")?"true":"false") ."\n";
//*/

/*
echo "=============== Exists Checks ===============\n";
echo "successful user exists: ". (UserModel::Exists("email","blah")?"true":"false") . "\n";
echo "failed user exists: ". (UserModel::Exists("email","doesnotexist")?"true":"false") . "\n";
//*/

/*
echo "\n\n=============== Login Checks ===============\n";
echo "successful user login: "; print_r(UserModel::Login("email","blah"));
echo "failed user login: "; print_r(UserModel::Login("doesnot","exist"));
//*/

/*
echo "\n\n=============== DeleteQuery Checks ===============\n";
$delete = new DeleteQuery();
$delete->From("users")->Where("email","=","email","and")->Where("password","=","blah");
//print_r($delete->Query());
testQuery($delete);
//*/

$test = QueryBuilder::Build("select");
$test->Select("id","email","password")->From("users")->Where(["id","=","1","and"],["email","=","asd","or"],["password",">=","4"])->Limit();
echo $test->Query();
?>
</pre>