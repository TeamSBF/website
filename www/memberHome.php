<?php require_once("header.php");?>


<?php
$enrollStat = "";
$ques1Stat = ""; 
$ques2Stat = "";
$parqStat ="";	

//---------------------------------------------validation--------------------------------	
	if(isset($_POST))
	{
		$_POST['userID'] = $user->id;
		$validator = new FormsModel($_POST); //------------------------
//		$validator = new FormsModelTemp($_POST);
		if (isset($_POST['submitEnrollment']))
		{
			
		//$validator = new FormsModel($_POST);
			$returnEnroll = $validator->ValidateEnrollment();
			echo "returnEnroll= " .$returnEnroll ;
		}
	
		else if (isset($_POST['submitParQ']))
		{
			$returnParQ = $validator->ValidateParQ();
		}
/*		else if (isset($_POST['submitQ1']))
		{
			$returnQues1 = $validator->ValidateQuestionnaireP1();
		}
		else if (isset($_POST['submitQ2']))
		{
			$returnQues2 = $validator->ValidateQuestionnaireP1();
		}
		*/
	}
	
//-----------------------------------lock completed forms-------------------------------------------
	if(FormsModel::isEnrollmentComplete())
	//	if(FormsModelTemp::isEnrollmentComplete())
		$enrollStat = "lock";
	
	if(FormsModel::isParQComplete())	
		$parqStat = "lock";
/*
	if(FormsModel::isQues1Complete())	
		$ques1Stat = "lock";

	if(FormsModel::isQues2Complete())	
		$ques2Stat = "lock";
*/	
//----------------------------------------errors-------------------------------------------------
	if(isset($returnEnroll) && $returnEnroll==false && $enrollStat != "lock")
	{
		$enrollStat = "error";
	}
	if(isset($returnParQ) && $returnParQ==false && $parqStat != "lock")
	{
		$parqStat = "error";
	}
	if(isset($returnQues1) && $returnQues1==false && $ques1Stat != "lock")
	{
		$ques1Stat = "error";
	}
	if(isset($returnQues2) && $returnQues2==false && $ques2Stat != "lock")
	{
		$ques2Stat = "error";
	}

?>
<div class="background">
<h1 class="demoHeaders">Forms</h1>
<!-- Accordion -->
    <div id="accordion">
        <div class="accordion-section-title" target="<?php echo $enrollStat;?>"><a href="#accordion-1">enrollment form</a></div>
        <div id="accordion-1" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-1" ).load( "enrollmentForm.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $ques1Stat;?>"><a href="#accordion-2">Questionnair 1</a></div>
        <div id="accordion-2" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-2" ).load( "questionnaireP1.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $ques2Stat;?>"><a href="#accordion-3">Questionnaire 2</a></div>
        <div id="accordion-3" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-3" ).load( "questionnaireP2.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $$parqStat;?>"><a href="#accordion-4">Paq Q</a></div>
        <div id="accordion-4" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-4" ).load( "parQ.php" );</script></div>
        </div>
    </div>
</div>
<?php require_once("footer.php");?>