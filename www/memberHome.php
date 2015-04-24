<?php
require_once("header.php");
?>

<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/accordion.js"></script>
<link rel="stylesheet" type="text/css" href="assets/accordion.css">
<?php
$enrollStat = "";
$ques1Stat = ""; 
$ques2Stat = "";
$parqStat ="";
//check for completed forms
//completedForms = formModel::completedForms(id);
//	
//	if(completedForms['questionare1'])
		//lock q1
//	if(completedForms['questionare2'])
		//lock q2
//	if(completedForms['parq'])
		//lock parq

//check if error on form	

//---------------------------------------------validation--------------------------------	
	if (isset($_POST['submitEnrollment']))
    {
      //echo var_dump($_POST); //DEBUG
      $validator = new FormsModel($_POST);
      $returnEnroll = $validator->ValidateEnrollment();
	  
	  echo "returnEnroll: " . $returnEnroll;
    }
	
//----------------------------------------------------------------------------------
//	if(isset($returnEnroll) && $returnEnroll)
//		$enrollStat = "lock";
	
	//else
	if(isset($returnEnroll) && $returnEnroll==false && $enrollStat != "lock")
	{
		$enrollStat = "error";
	}
	//else if(isset(enrollsubmit))
		//enroll.click
	//else if(isset(enrollsubmit))
		//enroll.click
	//else if(isset(enrollsubmit))
		//enroll.click
	
//place into hidden variables
// lock section
//check last form

?>  
   <div class="accordion">
		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $enrollStat;?>" href="#accordion-1">enrollment form</a>
			<div id="accordion-1" class="accordion-section-content">
				<div>
					<?php require_once("enrollmentFormTemp.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $ques1Stat;?>" href="#accordion-2">questionnaire 1</a>
			<div id="accordion-2" class="accordion-section-content">
				<div>
					<?php require_once("questionnaireP1Temp.php"); ?>
				</div>
				
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $ques2Stat;?>" href="#accordion-3">questionnaire 2</a>
			<div id="accordion-3" class="accordion-section-content">
				<div>
					<?php require_once("questionnaireP2Temp.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->
		
		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $parqStat;?>" href="#accordion-4">ParQ form</a>
			<div id="accordion-4" class="accordion-section-content">
				<div>
					<p> parq stuff</p>
					<?php //require_once("parq.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->
		
		
	</div><!--end .accordion-->

<?php

require_once("footer.php");
?>