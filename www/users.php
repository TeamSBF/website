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

if(isset($_GET['edit']) && isset($_POST['id'])) // editing users
{
    $_POST['id'] = Validator::instance()->SanitizeArray("int", $_POST['id']);
    $select = QueryFactory::Build("select")->Select('id','email','pLevel','activated')->From("users");
    $ids = $_POST['id'];
    for($i = 0; $i < count($ids); $i++)
    {
        $id = $ids[$i];
        // double protection to prevent the super user from being edited
        if($id === "1") continue;
        
        $where = ["id","=", $id];
        if($i < count($ids) - 1)
            $where[] = "OR";
        $select->Where($where);
    }
    $res = DatabaseManager::Query($select);
    if($res->RowCount() > 0)
    {
        if($res->RowCount() < 2)
            $res = [$res->Result()];
        else
            $res = $res->Result();
        
        $header = createHeader(array_keys($res[0]));
        $row = "";
        $table = "";
        foreach($res as $result)
        {
            $keys = array_keys($result);
            $formElements = "";
            foreach($keys as $key)
            {
                if($key === "id")
                {
                    $input = PartialParser::Parse('hidden', ["name" => "id[]", "value" => $result['id']]).$result['id'];
                }
                else if($key === "email")
                {
                    $input = PartialParser::Parse('text', ["name"=> "email".$result['id'], "value"=> $result[$key], "size" => 15]);
                }
                else if($key === "pLevel")
                {
                    $dropdown = new DropDown("userlevel".$result['id'], $userLevels, array_search($result[$key], $userLevels));
                    $input = $dropdown->Html();
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
                
                $formElements .= PartialParser::Parse('table-cell', ["content" => $input]);
            }
            $row .= PartialParser::Parse('table-row', ["content"=> $formElements]);
        }
        $formElements = $row;
        // create the save button
        $input = PartialParser::Parse('button', ["value" => "Save", "type" => "submit", "id" => "save"]);
        // create the cancel button
        $input .= PartialParser::Parse('button', ["name" => "cancel", "value" => "Cancel", "type" => "button", "id" => "cancel"]);
        // add them to the table
        $formElements .= $input;
        
        $data["action"] = $_SERVER['PHP_SELF']."?save";
    }
}
else // not editing users
{
    // since this uses a get variable, we must be careful as it can simply be typed in
    if(isset($_GET['save']) && isset($_POST['id']) && is_array($_POST['id'])) // save changes to the users
    {
        //printr($_POST);
        $ids = Validator::instance()->SanitizeArray("int", $_POST['id']);
        $rows = 0;
        foreach($ids as $id)
        {
            $email = $_POST['email'.$id];
            $level = $_POST['userlevel'.$id];
            $activated = $_POST['activated'.$id];
            $update = QueryFactory::Build("update")->Table('users');
            $update->Set(["email",$email],["pLevel",$level],["activated",$activated]);
            $update->Where(["id","=",$id]);
            $res = DatabaseManager::Query($update);
            $rows += $res->RowCount();
        }
        if($rows < 1)
            echo "Error: User(s) were not updated or there were no changes to save.";
        else
            echo "Users were successfully updated.";
        unset($res, $update, $email, $ids, $id, $level, $activated);
    }
    else if(isset($_GET['delete']) && isset($_POST['id']))
    {
        $id = (int)Validator::instance()->Sanitize("int", $_POST['id']);
        if(is_int($id))
        {
            $delete = QueryFactory::Build("delete")->From("users")->Where(["id", "=", $id]);
            $res = DatabaseManager::Query($delete);
            if($res->RowCount() > 0)
                echo "User successfully deleted";
            else
                echo "Error deleting user or user does not exist";
        }
    }
    
    $select = QueryFactory::Build("select")->Select('id','email','pLevel','created','activated')->From("users")->Where(['id','!=',$user->id,"AND"],['pLevel','<=',$user->AccessLevel]);
    $res = DatabaseManager::Query($select);
	if($res->RowCount() < 1)
		$res = false;
	else if($res->RowCount() < 2)
		$res = [$res->Result()];
	else
		$res = $res->Result();
	
	if($res)
	{
		$page .= PartialParser::Parse('div',["classes"=>"header", "content" => "Registered Users"]);
		$header = createHeader(array_merge(["Edit"], array_keys($res[0]), [""]));
	}
	
	$formElements = "";
	if($res)
		foreach($res as $result)
		{
			$editBtn = PartialParser::Parse('checkbox', ['name' => 'id', 'value' => $result['id']]);        
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
			
			$input = PartialParser::Parse('button', ["name" => "delete", "value" => "Delete", "type" =>"button", "id" => "delete".$result['id']]);
			// create the table cell
			$row.= PartialParser::Parse('table-cell', ["content" => $input]);
			// add the pieces of the form together
			$formElements .= PartialParser::Parse('table-row', ["content" => $row]);
		}
	// add an edit button to the form
	if($res)
		$formElements .= PartialParser::Parse('button',["type"=>"submit", "value" => "Edit", "id" => "editusers"]);
	$formElements .= PartialParser::Parse('button',["type"=>"button", "value" => "Add", "id" => "adduser"]);
	$data["action"] = $_SERVER['PHP_SELF']."?edit";
	$tableID = "users";
}

$data["content"] = ($res ? $header : "").$formElements;
$data["method"] = "POST";
// wrap all the contents into a form field
$form = PartialParser::Parse('form', $data);

// add the table to the page
$page = PartialParser::Parse('table',["content" => $form, "id" => (isset($tableID) ? $tableID : "")]);
// wrap the page in the background div and display it
echo PartialParser::Parse('div', ["classes" => "background", "content" => $page]);
?>

<div id="dialog-confirm" title="Delete the user?" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 80px 0;"></span>The user will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<div id="addUserDialog" title="Add User" style="display:none;">
	<form name="adduser" method="POST" action="users.php?adduser">
    <div class="table">
        <div class="row">
            <div class="cell">Email Address</div>
            <div class="cell"><input type="text" name="email" value="" /></div>
        </div>
        <div class="row">
            <div class="cell">Password</div>
            <div class="cell"><input type="password" name="pass" value="" /></div>
        </div>
        <div class="row">
            <div class="cell">Access Level</div>
            <div class="cell">
                <select name="accesslevel">
                    <option value="1">Member</option>
                    <option value="2">Admin</option>
                    <option value="3">Super</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="cell">Activated</div>
            <div class="cell">
                <label><input type="radio" name="activated" value="1" />Yes</label><br />
                <label><input type="radio" name="activated" value="0" />No</label>
            </div>
        </div>
    </div>
	</form>
</div>
<script>
$(document).ready(function(){
    $("#cancel").on('click', function(){window.location.href = "users.php";});
    $("button[id*='delete'").on('click', function(){
        var id = $(this).attr('id').match(/\d+/);
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            modal: true,
            buttons: {
                "Delete": function() {
                    $("#dialog-confirm").html('<form name="delete" action="users.php?delete" method="POST" style="display:none;"><input type="hidden" name="id" value="' + id + '" /></form>');
                    $(document.forms['delete']).submit();
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    $("#adduser").on('click', function(){
        $("#addUserDialog").dialog({
            resizable: false,
            width: 'auto',
            height: 'auto',
            modal: true,
            buttons: {
                "Add User": function() {
					$(document.forms['adduser']).submit();
                    $(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
    });
});
</script>
<?php require_once"footer.php";?>