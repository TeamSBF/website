<?php require_once("header.php");?>

<div class="background">
<h1 class="demoHeaders">Forms</h1>
<p>Please take the time to answer these questions to help us analyze the efficiency of our Sit and Be Fit program on our audience.
After each form submission you can take a break and finish the rest anytime.</p><p> Thank you for your time!</p>
<!-- Accordion -->
    <div id="accordion">
    	<h2 id="acc1">Enrollment Form</h2>
        <div id="accordion-1" class="accordion-section-content">
            <?php require_once"enrollmentForm.php"; ?>
        </div>
    
    	<h2 id="acc2">Pre-Study Questionnaire Part 1</h2>
        <div id="accordion-2" class="accordion-section-content">
            <?php require_once"questionnaireP1.php"; ?>
        </div>

        <h2 id="acc3">Pre-Study Questionnaire Part 2</h2>
        <div id="accordion-3" class="accordion-section-content">
            <?php require_once"questionnaireP2.php"; ?>
        </div>
        
        <h2 id="acc4">ParQ Form</h2>
        <div id="accordion-4" class="accordion-section-content">
            <?php require_once"parQ.php"; ?>
        </div>
	</div>
</div>
<script>

$(document).ready(function () {
	<?php
	$user_id = $user->id;
	if (FormsModel::isEnrollmentComplete($user_id))
	{ ?>
		$("#acc1").css("background", "#66CCFF");
		$("#acc1").html("Enrollment Form - <strong>Completed</strong>");
		$("#submitEnrollment").prop("disabled", "true");
	<?php }

	if(FormsModel::isParQComplete($user_id))	
	{ ?>
		$("#acc2").css("background", "#66CCFF");
		$("#acc2").html("Pre-Study Questionnaire Part 1 - <strong>Completed</strong>");
		$("#submitQuestionnaireP1").prop("disabled", "true");
	<?php }

	if(FormsModel::isQues1Complete($user_id))	
	{ ?>
		$("#acc3").css("background", "#66CCFF");
		$("#acc3").html("Pre-Study Questionnaire Part 2 - <strong>Completed</strong>");
		$("#submitQuestionnaireP2").prop("disabled", "true");
	<?php }

	if(FormsModel::isQues2Complete($user_id))	
	{ ?>
		$("#acc4").css("background", "#66CCFF");
		$("#acc4").html("ParQ Form - <strong>Completed</strong>");
		$("#submitParQ").prop("disabled", "true");
	<?php }

	?>
});
</script>

<?php require_once("footer.php"); ?>