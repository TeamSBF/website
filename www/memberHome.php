<?php require_once("header.php");?>

<div class="background">
<h1 class="demoHeaders">Forms</h1>
<div id="introText"><p>Please take the time to answer these questions to help us analyze the efficiency of our Sit and Be Fit program on our audience.
After each form submission you can take a break and finish the rest anytime.</p><p> Thank you for your time!</p></div>
<div id="formsDoneMessage" style="display:none"><p>Thank you for taking the time to complete this survey!<br>Click here to access the Physical Assessments page:</p></div>
<div><button type="button" id="assessmentPageLink" style="display:none">Assessments</button></div>
<!-- Accordion -->
    <div id="accordion2">
    	<h2 id="acc1">Enrollment Form</h2>
        <div id="accordion-1" class="accordion-section-content">
            <?php require_once"enrollmentForm.php"; ?>
        </div>
    
    	<h2 id="acc2">Pre-Study Questionnaire</h2>
        <div id="accordion-2" class="accordion-section-content">
            <?php require_once"questionnaire.php"; ?>
        </div>
        
        <h2 id="acc3">ParQ Form</h2>
        <div id="accordion-3" class="accordion-section-content">
            <?php require_once"parQ.php"; ?>
        </div>
	</div>
</div>
<script>

$(document).ready(function () {
	<?php
	$formsDone = true;
	$user_id = $user->id;
	if (FormsModel::isEnrollmentComplete($user_id))
	{ ?>
		$("#acc1").css("background", "#66CCFF");
		$("#acc1").html("Enrollment Form - <strong>Completed</strong>");
		$("#submitEnrollment").prop("disabled", "true");
	<?php }
	else 
	{ 
		$formsDone = false;
	}

	if(FormsModel::isQuestionnaireComplete($user_id))	
	{ ?>
		$("#acc2").css("background", "#66CCFF");
		$("#acc2").html("Pre-Study Questionnaire - <strong>Completed</strong>");
		$("#submitQuestionnaire").prop("disabled", "true");
	<?php }
	else 
	{ 
		$formsDone = false;
	}

	if(FormsModel::isParQComplete($user_id))	
	{ ?>
		$("#acc3").css("background", "#66CCFF");
		$("#acc3").html("ParQ Form - <strong>Completed</strong>");
		$("#submitParQ").prop("disabled", "true");
	<?php }
	else 
	{ 
		$formsDone = false;
	}

	if ($formsDone == true)
	{ ?>
		$("#formsDoneMessage").show();
		$("#introText").hide();
		$("#assessmentPageLink").show();
	<?php
	} ?>
});
	$("#assessmentPageLink").on("click", function() {
		window.location.href = "assessments.php";
	})
</script>

<?php require_once("footer.php"); ?>