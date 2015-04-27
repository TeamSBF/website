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

//---------------------------------------------validation--------------------------------	
	if(isset($_POST))
	{
		//$validator = new FormsModel($_POST); //------------------------
		$validator = new FormsModelTemp($_POST);
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
	//if(FormsModel::isEnrollmentComplete())
		if(FormsModelTemp::isEnrollmentComplete())
		$enrollStat = "lock";
	
//	if(FormsModel::isParQComplete())	
	if(FormsModelTemp::isParQComplete())
		$parqStat = "lock";
/*
//	if(FormsModel::isQues1Complete())	
	if(FormsModelTemp::isQues1Complete())
		$ques1Stat = "lock";

//	if(FormsModel::isQues2Complete())	
	if(FormsModelTemp::isQues2Complete())
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
   <div class="accordion">
		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $enrollStat;?>" href="#accordion-1">enrollment form</a>
			<div id="accordion-1" class="accordion-section-content">
				<div>
					<?php require_once("enrollmentFormTemp.php"); //require_once("enrollmentForm.php");?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $ques1Stat;?>" href="#accordion-2">questionnaire 1</a>
			<div id="accordion-2" class="accordion-section-content">
				<div>
					<?php require_once("questionnaireP1Temp.php"); //require_once("questionnaireP1.php"); ?>
				</div>
				
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $ques2Stat;?>" href="#accordion-3">questionnaire 2</a>
			<div id="accordion-3" class="accordion-section-content">
				<div>
					<?php require_once("questionnaireP2Temp.php"); //require_once("questionnaireP2.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->
		
		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo $parqStat;?>" href="#accordion-4">ParQ form</a>
			<div id="accordion-4" class="accordion-section-content">
				<div>
					<?php require_once("parQTemp.php");//require_once("parQ.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->
		
		
	</div><!--end .accordion-->

<?php

require_once("footer.php");
?>