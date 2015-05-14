<?php require_once"header.php";

function createHeader($keys)
{
    $row = "";
    foreach($keys as $header)
    {
        if($header === "pLevel")
            $header = "Permission Level";
        else if($header !== "")
            $header[0] = strtoupper($header[0]);
        $row .= PartialParser::Parse('table-cell', ["content" => $header]);
    }
    
    return PartialParser::Parse('table-row', ["content" => $row]);
}

$page = "";
$userLevels = (new ReflectionClass("UserLevel"))->getConstants();
unset($userLevels['Anon']);

if(!isset($_GET['edit'])) // not editing users
{
    $select = QueryFactory::Build("select")->Select('id','email','pLevel','created','activated')->From("users");
    $res = DatabaseManager::Query($select);
    if($res->RowCount() < 2)
        $res = [$res->Result()];
    else
        $res = $res->Result();
        
    $page .= PartialParser::Parse('div',["classes"=>"header", "content" => "Registered Users"]);
    $header = createHeader(array_merge(["Edit"],array_keys($res[0])));
    
    $form = "";
    foreach($res as $result)
    {
        $data = ['name' => 'id', 'value' => $result['id']];
        $editBtn = PartialParser::Parse('checkbox', $data);
        $row = PartialParser::Parse('table-cell', ["content" => $editBtn]);
        
        $keys = array_keys($result);
        foreach($keys as $key)
        {
            $content = "";
            if($key === "activated")
                $content = $result['activated'] === "1" ? "Yes" : "No";
            else if($key === "pLevel")
                $content = array_search($result['pLevel'], $userLevels);
            else
                $content = $result[$key];
           
           $row .= PartialParser::Parse("table-cell", ["content" => $content]);
        }
        // add the pieces of the form together
        $form .= PartialParser::Parse('table-row', ["content" => $row]);
    }
    // add a submit button to the form
    $form .= PartialParser::Parse('button',["type"=>"submit", "value" => "Edit"]);
    
    $data = ["content" => $header.$form, "action" => $_SERVER['PHP_SELF']."?edit", "method" => "POST"];
    // build the table based on the form data
    $table = PartialParser::Parse('form', $data);
    
    // add the table to the page
    $page .= PartialParser::Parse('table',["content" => $table]);
}else{ // editing users
    $_POST['id'] = Validator::instance()->SanitizeArray("int", $_POST['id']);
    $select = QueryFactory::Build("select")->Select('id','email','pLevel','activated')->From("users");
    for($i = 0; $i < count($_POST['id']); $i++)
    {
        $where = ["id","=",$_POST['id'][$i]];
        if($i < count($_POST['id'])-1)
            $where[] = "OR";
        $select->Where($where);
    }
    $res = DatabaseManager::Query($select);
    if($res->RowCount() < 2)
        $res = [$res->Result()];
    else
        $res = $res->Result();
    
    $header = createHeader(array_keys($res[0]));
    $row = "";
    foreach($res as $result)
    {
        $keys = array_keys($result);
        $content = "";
        foreach($keys as $key)
        {
            if($key === "id" || $key === "email")
            {
                $size = 1;
                if($key === "email")
                    $size = 15;
                $input = PartialParser::Parse('text', ["name"=>$key.$result['id'],"value"=> $result[$key], "size" => $size]);
            }
            else if($key === "pLevel")
            {
                $dropdown = new DropDown("userlevel".$result['id'], $userLevels, array_search($result[$key], $userLevels));
                $input = $dropdown->Html();
                //printr($userLevels);
            }
            else if($key === "activated")
            {
                $checked = $result[$key];
                $values = [["Yes","1"],["No","0"]];
                $radio = new RadioGroup($key.$result['id'], $checked, $values);
                $input = $radio->Html();          
            }
            else
                $input = $result[$key];
            $content .= PartialParser::Parse('table-cell', ["content" => $input]);
        }
        $row .= PartialParser::Parse('table-row', ["content"=> $content]);
    }
    
    $page .= PartialParser::Parse('table', ["content" => $header.$row]);
}

echo PartialParser::Parse('div', ["classes" => "background", "content" => $page]);

require_once"footer.php";