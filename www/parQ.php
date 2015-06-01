<?php
 	if (isset($_POST['submitParQ']))
    {
        $_POST['userID'] = $user->id;
        //printr($_POST);
        $parQvalidator = new FormsModel($_POST);
        $parQreturn = $parQvalidator->validateParQ();
        //printr($parQreturn);
    }
?>

<div class="background">
<form method="post" id="parQform">
	<h1><strong>Par-Q Form</strong></h1>
	<div>
		<h2>The Physical Activity Readiness Questionnaire for Everyone</h2>
		<p>Regular physical activity is fun and healthy, and more people should become more physically active every day of the week.
Being more physically active is very safe for MOST people. This questionnaire will tell you whether it is necessary for you to
seek further advice from your doctor OR a qualified exercise professional before becoming more physically active.</p>
		<div id="parQmessage" class="success" style="display:none"></div>
<?php
$disclaimer = PartialParser::Parse('tag',['tag'=>"p", 'content' => "Please read the questions below carefully and answer each one honestly: check YES or NO."]);
$keys = array_keys($parq_questions);
$page = "";
$showSection2 = false;
for($i = 0; $i < count($keys); $i++)
{
    $key = $keys[$i];
    $legend = PartialParser::Parse('tag',["tag"=>"legend", "content"=>"SECTION ".($i+1)." - ".$key]);
    $section = $parq_questions[$key];
    $questions = "";
    for($j = 0; $j < count($section); $j++)
    {
        $id = ($i + 1)."_".($j + 1);
        $questions .= PartialParser::Parse('div',['content'=>$section[$j]->html($id),'id'=>'s'.($i+1).'RadioGroup']);
        if($section[$j]->showSubs())
            $showSection2 = true;
    }
    $fieldset = PartialParser::Parse('tag',['tag'=>'fieldset', 'content'=>$legend.$disclaimer.$questions]);
    
    $details = ['id'=>'section'.($i+1),'content'=>$fieldset];
    if($i > 0 && !$showSection2)
    {
        $details['style'] = 'display:none;';
    }
    $page .= PartialParser::Parse('div', $details)."<br /><br />";
}

echo PartialParser::Parse('div',['content'=>$page]);?>
		<div>
			<legend>SECTION 3 - DECLARATION</legend>
			<p>›› You are encouraged to photocopy the PAR-Q+. You must use the entire questionnaire and NO changes are permitted.</p>
			<p>›› The Canadian Society for Exercise Physiology, the PAR-Q+ Collaboration, and their agents assume no liability for persons
				who undertake physical activity. If in doubt after completing the questionnaire, consult your doctor prior to physical activity.</p>
			<p>›› If you are less than the legal age required for consent or require the assent of a care provider, your parent, guardian or care
				provider must also sign this form.</p>
			<p>›› Please read and sign the declaration below:
				I, the undersigned, have read, understood to my full satisfaction and completed this questionnaire. I acknowledge that
				this physical activity clearance is valid for a maximum of 12 months from the date it is completed and becomes invalid
				if my condition changes. I also acknowledge that a Trustee (such as my employer, community/fitness centre, health
				care provider, or other designate) may retain a copy of this form for their records. In these instances, the Trustee will be
				required to adhere to local, national, and international guidelines regarding the storage of personal health information
				ensuring that they maintain the privacy of the information and do not misuse or wrongfully disclose such information.</p>
			<fieldset>

				   <div><label for="dateCompleted"><p>Date Completed</p></label>
				    <input type="date" class="" name="q3_1" required value="<?php if(isset($_POST['q3_1'])){echo htmlspecialchars($_POST['q3_1']);} ?>"></div>
                <div>
				    <label for="signature"><p>Signature (type your full name)</p></label>
				    <input type="text" class="" name="q3_2" required placeholder="Sign here" value="<?php if(isset($_POST['q3_2'])){echo htmlspecialchars($_POST['q3_2']);} ?>"></div>
                <div>
				    <label for="guardianSignature"><p>Parent/Guardian/Care Provider Signature (If applicable)</p></label>
                    <input type="text" class="" name="q3_3" placeholder="Sign here" value="<?php if(isset($_POST['q3_3'])){echo htmlspecialchars($_POST['q3_3']);} ?>"></div>
			</fieldset>
		</div>
	</div>
    <div class="parqInput"><button type="submit" id="submitParQ" name="submitParQ">Submit</button></div>
</form> <!-- end Form -->
</div>
	
<script>
	/* Loops through section 1 answers and decide if section 2 should be shown/hidden */
	$(".s1Radios").change(function () {
		showHideSection2();		
	});

	// show or hide section depending on input from section 1
	function showHideSection2() {
		var show = false;
		$(".s1Radios").each(function () {
			if ($(this).is(":checked") && $(this).val() == 1) {
				show = true;
				return false;
			}			
		});
		var questions = 7;
		if (show) {
			$("#section2").show("slow");
			switchRequiredAttribute("q2", questions, "true");
					
		}
		else {
			$("#section2").hide("slow");
			switchRequiredAttribute("q2", questions, "false");
			// loop through main section 2 questions and set their subquestions to non-required if needed
			var name, radio;
			for (var i = 1; i <= questions; i++) {
				name = "q2." + i;
				radio = document.getElementsByName(name);
				if ($(radio).is(":checked")) {
					$(radio).prop("checked", false);
					loopSubQuestions(name);
				}
			}
		}
	}

	// switch the required attribute between true and false depending on input
	function switchRequiredAttribute(name, howmany, value)	{
		for (var i = 1; i <= howmany; i++) {
            var input = "input[name='"+name+"_"+i+"']";
			if (value === "false")
				$(input).attr("required", false);
			else
				$(input).attr("required", true);
		}
			
	}

	/* Generic function for all section 2 questions, if yes show sub-questions, if no hide */
    $("#section2 input").on('click', function () {
        var input = $(this);
        var name = input.attr('name');
        var subs = $('#'+name);
        if(subs.length)
        {
            if(!subs.is(':visible') && input.val() == 1)
            {
                subs.show("slow");
                switchRequiredAttribute(input.attr('name'), subs.length, "true");
            }
            else
            {
                subs.hide("slow");
                loopSubQuestions(input.attr('name'));
            }
        }
	});

	function loopSubQuestions(divID) {
		var count = $("#"+divID+" > div").length;
		$("#"+ divID).hide("slow");			
		switchRequiredAttribute(divID, count, "false");
		uncheckSubQuestions(divID, count);
	}

	function uncheckSubQuestions(name, count) {
		for (var i = 1; i <= count; i++) {
			$("input[name='"+name+"_"+i+"']").prop("checked", false);
		}
	}

	<?php 	if(isset($parQreturn)) { ?>
		// on document ready, figure out if section should be shown (on page reload after submitting maybe it should show)
		// display message upon success  or error
		$(document).ready(function () {
			showHideSection2(); 
			var message;
			<?php if ($parQreturn == false) { ?>
				message = "<strong>Error!</strong> Something went wrong while saving the form data.";
				$("#parQmessage").removeClass("success").addClass("error");
				$("#parQmessage").html(message);
				$("#parQmessage").show();			    
				<?php 	}
				else { ?>
					message = "<strong>Success!</strong?> Form submitted!";			    
					$("#parQmessage").removeClass("error").addClass("success");
					$("#parQmessage").html(message);
					$("#parQmessage").show();					
					<?php } ?>
				}); 
	<?php } ?>

</script>