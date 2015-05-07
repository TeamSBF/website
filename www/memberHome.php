<?php require_once("header.php");?>


<?php
$enrollStat = "";
$ques1Stat = ""; 
$ques2Stat = "";
$parqStat ="";	

//-----------------------------------lock completed forms-------------------------------------------
	if(FormsModel::isEnrollmentComplete())
	//	if(FormsModelTemp::isEnrollmentComplete())
		$enrollStat = "lock";
	
	if(FormsModel::isParQComplete())	
		$parqStat = "lock";

	if(FormsModel::isQues1Complete())	
		$ques1Stat = "lock";

	if(FormsModel::isQues2Complete())	
		$ques2Stat = "lock";
	
//----------------------------------------errors-------------------------------------------------
	if(isset($enrollmentReturn) && $enrollmentReturn==false && $enrollStat != "lock")
	{
		$enrollStat = "error";
	}
	if(isset($parQreturn) && $parQreturn==false && $parqStat != "lock")
	{
		$parqStat = "error";
	}
	if(isset($q1return) && $q1return==false && $ques1Stat != "lock")
	{
		$ques1Stat = "error";
	}
	if(isset($q2return) && $q2return==false && $ques2Stat != "lock")
	{
		$ques2Stat = "error";
	}

?>
<div class="background">
<h1 class="demoHeaders">Forms</h1>
<!-- Accordion -->
    <div id="accordion">
        <div class="accordion-section-title" target="<?php echo $enrollStat;?>"><a href="#accordion-1">Enrollment Form</a></div>
        <div id="accordion-1" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-1" ).load( "enrollmentForm.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $ques1Stat;?>"><a href="#accordion-2">Pre-Study Questionnaire Part 1</a></div>
        <div id="accordion-2" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-2" ).load( "questionnaireP1.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $ques2Stat;?>"><a href="#accordion-3">Pre-Study Questionnaire Part 2</a></div>
        <div id="accordion-3" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-3" ).load( "questionnaireP2.php" );</script></div>
        </div>
        
        <div class="accordion-section-title" target="<?php echo $$parqStat;?>"><a href="#accordion-4">Par-Q Form</a></div>
        <div id="accordion-4" class="accordion-section-content">
            <div class="accordion-section"><script>$( "#accordion-4" ).load( "parQ.php" );</script></div>
        </div>
    </div>
</div>
<?php require_once("footer.php");?>