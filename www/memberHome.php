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
//	if(completedForms['enrollment'])
		//lock enrollment
//	if(completedForms['questionare1'])
		//lock q1
//	if(completedForms['questionare2'])
		//lock q2
//	if(completedForms['parq'])
		//lock parq

//check if error on form	
	//if(isset(enrollsubmit))
		//enroll.click
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
			<a class="accordion-section-title" target="<?php echo enrollStat;?>" href=#accordion-1">enrollment form</a>
			<div id="accordion-1" class="accordion-section-content">
				<div>
					<?php //require_once("enrollmentForm.php"); ?>
				</div>
				<p>Mauris interdum fringilla augue vitae tincidunt. Curabitur vitae tortor id eros euismod ultrices. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nulla mi, rutrum ut feugiat at, vestibulum ut neque? Cras tincidunt enim vel aliquet facilisis. Duis congue ullamcorper vehicula. Proin nunc lacus, semper sit amet elit sit amet, aliquet pulvinar erat. Nunc pretium quis sapien eu rhoncus. Suspendisse ornare gravida mi, et placerat tellus tempor vitae.</p>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo ques1Stat;?>" href=#accordion-2">questionare 1</a>
			<div id="accordion-2" class="accordion-section-content">
				<div>
					<?php //require_once("questionare1.php"); ?>
				</div>
				<p>Mauris interdum fringilla augue vitae tincidunt. Curabitur vitae tortor id eros euismod ultrices. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nulla mi, rutrum ut feugiat at, vestibulum ut neque? Cras tincidunt enim vel aliquet facilisis. Duis congue ullamcorper vehicula. Proin nunc lacus, semper sit amet elit sit amet, aliquet pulvinar erat. Nunc pretium quis sapien eu rhoncus. Suspendisse ornare gravida mi, et placerat tellus tempor vitae.</p>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->

		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo ques2Stat;?>" href=#accordion-3">questionare 2</a>
			<div id="accordion-3" class="accordion-section-content">
				<div>
					<?php //require_once("questionare2.php"); ?>
				</div>
			</div><!--end .accordion-section-content-->
		</div><!--end .accordion-section-->
		
		<div class="accordion-section">
			<a class="accordion-section-title" target="<?php echo parqStat;?>" href=#accordion-4">ParQ form</a>
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