<?php
if (isset($_POST['submitEnrollment']))
{
    $_POST['userID'] = $user->id;       
    $enrollmentValidator = new FormsModel($_POST);
    $enrollmentReturn = $enrollmentValidator->validateEnrollment();
}

$items = [
    [
        PartialParser::Parse("label",['for'=>'lName','content'=>'<b>Last Name</b>']),
        PartialParser::Parse("text",['name'=>'lName', 'placeholder'=>'Doe', 'required'=>'required','value'=>(isset($_POST['lName'])?htmlspecialchars($_POST['lName']):"")])
    ],
    [
        PartialParser::Parse("label",['for'=>'fName','content'=>'<b>First Name</b>']),
        PartialParser::Parse("text",['name'=>'fName','placeholder'=>'John', 'required'=>'required', 'value'=>(isset($_POST['fName'])?htmlspecialchars($_POST['fName']):"")])
    ],
    [
        PartialParser::Parse('label',['for'=>'streetAddress','content'=>'<b>Street Address</b>']),
        PartialParser::Parse('textarea',['name'=>'streetAddress','placeholder'=>'123 Fake St', 'rows'=>'3', 'cols'=>'27', 'style'=>'width:auto;', 'content'=>(isset($_POST['streetAddress'])?htmlspecialchars($_POST['streetAddress']):"")])
    ],
    [
        PartialParser::Parse("label",["for"=>"city", 'content'=>'<b>City</b>']),
        PartialParser::Parse('text',['name'=>'city', 'placeholder'=>'Spokane', 'value'=>(isset($_POST['city'])?htmlspecialchars($_POST['city']):"")])
    ],
    [
        PartialParser::Parse('label',['for'=>'phone', 'content'=>'<b>Phone</b>']),
        PartialParser::Parse('tel',['name'=>'phone', 'placeholder'=>'(509)555-5555', 'value'=>(isset($_POST['phone'])?htmlspecialchars($_POST['phone']):"")])
    ],
    [
        PartialParser::Parse('label', ['for'=>'email', 'content'=>'<b>E-mail</b>']),
        PartialParser::Parse('email', ['name'=>'email', 'placeholder'=>'johnDoe@abc', 'required'=>'required', 'value'=>(isset($_POST['email'])?htmlspecialchars($_POST['email']):"")])
    ],
    [
        PartialParser::Parse('label', ['for'=>'dob','content'=>'<b>Date of Birth</b>']),
        PartialParser::Parse('date',['name'=>'dob', 'required'=>'required', 'value'=>(isset($_POST['dob'])?htmlspecialchars($_POST['dob']):"")])
    ],
    [
        PartialParser::Parse('label',['content'=>'<b>Gender</b>']),
        PartialParser::Parse('radiobutton',['name'=>'gender', 'required'=>'required', 'value'=>'1', 'text'=>'Male', 'checked'=>(isset($_POST['gender']) && $_POST['gender'] == 1?"checked":"")]),
        PartialParser::Parse('radiobutton',['name'=>'gender', 'required'=>'required', 'value'=>'0', 'text'=>'Female', 'checked'=>(isset($_POST['gender']) && $_POST['gender'] == 0?"checked":"")])
    ],
    [
        PartialParser::Parse('label',['for'=>'healthHistory','content'=>'<b>Health History</b>']),
        PartialParser::Parse('textarea',['name'=>'healthHistory', 'rows'=>'4', 'cols'=>'27', 'style'=>'width:auto;', 'content'=>(isset($_POST['healthHistory'])?htmlspecialchars($_POST['healthHistory']):"")])
    ],
    [
        PartialParser::Parse('label',['content'=>'<b>Do you watch Sit and Be Fit?</b>']),
        PartialParser::Parse('radiobutton',['name'=>'watchSbf', 'required'=>'required','value'=>'1','text'=>'Yes', 'checked'=>(isset($_POST['watchSbf']) && $_POST['watchSbf'] == 1?"checked":"")]),
        PartialParser::Parse('radiobutton',['name'=>'watchSbf', 'value'=>'0','text'=>'No', 'checked'=>(isset($_POST['watchSbf']) && $_POST['watchSbf'] == 0?"checked":"")])
    ],
    [
        PartialParser::Parse('label',['for'=>'howMany','content'=>'<b>How many times a week?</b>']),
        PartialParser::Parse('number',['name'=>'howMany', 'value'=>(isset($_POST['howMany'])?htmlspecialchars($_POST['howMany']):"1")])
    ],
    [
        PartialParser::Parse('label',['for'=>'controlGrp', 'content'=>'<b>Control Group (will NOT participate in Sit and Be Fit)</b>']),
        PartialParser::Parse('radiobutton',['name'=>'controlGrp', 'required'=>'required','value'=>'1','text'=>'Yes', 'checked'=>(isset($_POST['controlGrp']) && $_POST['controlGrp'] == 1?"checked":"")]),
        PartialParser::Parse('radiobutton',['name'=>'controlGrp', 'value'=>'0','text'=>'No', 'checked'=>(isset($_POST['controlGrp']) && $_POST['controlGrp'] == 0?"checked":"")])
    ],
    [
        PartialParser::Parse('label',['for'=>'experimentalGrp', 'content'=>'<b>Experimental Group (participate in Sit and Be Fit)</b>']),
        PartialParser::Parse('radiobutton',['name'=>'experimentalGrp', 'required'=>'required','value'=>'1','text'=>'Yes', 'checked'=>(isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 1?"checked":"")]),
        PartialParser::Parse('radiobutton',['name'=>'experimentalGrp', 'value'=>'0','text'=>'No', 'checked'=>(isset($_POST['experimentalGrp']) && $_POST['experimentalGrp'] == 0?"checked":"")])
    ]
];

if($enrollment = FormsModel::isEnrollmentComplete($user->id))
{
    $select = QueryFactory::Build("select")->Select("lastName","firstName","streetAddress","city","phone","email","dob","gender","healthHistory","watchSbf","HowManyTimesAWeek","controlGroup","experimentalGroup");
    $select->From("enrollment_form")->Where(["userID","=",$user->id])->Limit();
    $select = DatabaseManager::Query($select);
    $results = $select->Result();
    $keys = array_keys($results);
    for($i = 0; $i < count($keys); $i++)
    {
        $key = $keys[$i];
        $value = $results[$key];
        if($key !== "HowManyTimesAWeek")
            if($value === "1")
            {
                $value = "Yes";
                if($key === "gender")
                    $value = "Male";
            }
            else if($value === "0")
            {
                $value = "No";
                if($key === "gender")
                    $value = "Female";
            }
        
        if($value === "")
            $value = "-";
        
        $items[$i] = [$items[$i][0],PartialParser::Parse("div",['content'=>$value])];
    }
}
?>

<div class="background">
<?php if(!$enrollment && $user->accesslevel < UserLevel::Admin){?>
    <form method="post">
<?php }?>
    <div class="formBackground">
        <legend><strong><h1>Enrollment Form</h1></strong></legend>
        <div id="enrollmentMessage" class="success" style="display:none"></div>
<?php   $page = "";
        foreach($items as $item){
            $content = "";
            foreach($item as $element)
                $content .= PartialParser::Parse("div",["classes"=>"input","content"=>$element."<br>"]);
            
            $page .= PartialParser::Parse("div",["content"=>$content]);
        }
        echo $page;
        
        if(!$enrollment && $user->accesslevel < UserLevel::Admin){?>
        <div class="enrollInput"><button type="submit" id="submitEnrollment" name="submitEnrollment">Submit</button></div>
<?php }?>
    </div>
    </form>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script>
    <?php   if(isset($enrollmentReturn)) { ?>
    // display message upon success  or error
    $(document).ready(function () {
      var message;
      <?php if ($enrollmentReturn == false) { ?>
        message = "<strong>Error!</strong> Something went wrong while saving the form data.\nHave you already completed and submitted this form?.";
        $("#enrollmentMessage").removeClass("success").addClass("error");
        $("#enrollmentMessage").html(message);
        $("#enrollmentMessage").show();         
        <?php   }
        else if ($enrollmentReturn == "success") { ?>
          message = "<strong>Success!</strong?> Form submitted!";          
          $("#enrollmentMessage").removeClass("error").addClass("success");
          $("#enrollmentMessage").html(message);
          $("#enrollmentMessage").show();         
          <?php }
        else { ?>
          message = "<strong>Error!</strong?> ";
          $("#enrollmentMessage").removeClass("success").addClass("error");
          $("#enrollmentMessage").html(message + '<?= $enrollmentReturn; ?>');
          $("#enrollmentMessage").show();
          <?php } ?>
        }); 
  <?php } ?>
</script>