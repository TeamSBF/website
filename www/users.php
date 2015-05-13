<?php
require_once"header.php";
$select = QueryFactory::Build("select")->Select('id','email','pLevel','created','activated')->From("users");
$res = DatabaseManager::Query($select);
if($res->RowCount() < 2)
    $res = [$res->Result()];
?>
<div class="background">
    <div class="header">Registered Users</div>
    <div class="users table">
    <?php
    $keys = array_keys($res[0]);
    $keys = array_merge(["Edit"], $keys);
    $row = "";
    foreach($keys as $header)
    {
        if($header === "pLevel")
            $header = "Permission Level";
        else if($header !== "")
            $header[0] = strtoupper($header[0]);
        $row .= PartialParser::Parse('table-cell', ["content" => $header]);
    }
    echo PartialParser::Parse('table-row', ["content" => $row]);
    /*$name = $key;
    $checked = $result[$key];
    $values = [["Yes","1"],["No","0"]];
    $radio = new RadioGroup($name, $checked, $values);
    $content .= $radio->Html();*/
    //*
    $levels = (new ReflectionClass("UserLevel"))->getConstants();
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
                $content = $result['activated'] === "0" ? "No" : "Yes";
            else if($key === "pLevel")
                $content = array_search($result['pLevel'], $levels);
            else
                $content = $result[$key];
           
           $row .= PartialParser::Parse("table-cell", ["content" => $content]);
        }
        
        echo PartialParser::Parse('table-row', ["content" => $row]);
    }
    //*/?>
    </div>
</div>
<?php require_once"footer.php";?>