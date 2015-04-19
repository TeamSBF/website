<?php
	require_once"header.php";

 	if (isset($_POST['submitParQ']))
    {
      //echo var_dump($_POST); //DEBUG
      $parQvalidator = new FormsModel($_POST);
      $parQreturn = $validator->ValidateParQ();
    } 
?>
<form method="post" class="form-vertical">
	<legend><strong>Par-Q Form</strong></legend>
	<section>
		<h2>The Physical Activity Readiness Questionnaire for Everyone</h2>
		<p>Regular physical activity is fun and healthy, and more people should become more physically active every day of the week.
Being more physically active is very safe for MOST people. This questionnaire will tell you whether it is necessary for you to
seek further advice from your doctor OR a qualified exercise professional before becoming more physically active.</p>
		<div id="parQmessage" style="display:none"></div>
		<section id="section1">
			
			<fieldset>
				<legend>SECTION 1 - GENERAL HEALTH</legend>
				<p>Please read the 7 questions below carefully and answer each one honestly: check YES or NO.</p>
				<div id="s1RadioGroup">
					<label for="q1">1: Has your doctor ever said that you have a heart condition OR high blood pressure?</label>
					<input type="radio" class="s1Radios" name="q1" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q1" value="No">No

					<label for="q2">2: Do you feel pain in your chest at rest, during your daily activities of living, OR when you do physical activity?</label>
					<input type="radio" class="s1Radios" name="q2" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q2" value="No">No

					<label for="q3">3: Do you lose balance because of dizziness OR have you lost consciousness in the last 12 months? 
									Please answer NO if your dizziness was associated with over-breathing (including during vigorous exercise):</label>
					<input type="radio" class="s1Radios" name="q3" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q3" value="No">No

					<label for="q4">4: Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?</label>
					<input type="radio" class="s1Radios" name="q4" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q4" value="No">No

					<label for="q5">5: Are you currently taking prescribed medications for a chronic medical condition?</label>
					<input type="radio" class="s1Radios" name="q5" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q5" value="No">No

					<label for="q6">6: Do you have a bone or joint problem that could be made worse by becoming more physically active? 
									Please answer NO if you had a joint problem in the past, but it does not limit your current ability to be physically active. 
									For example, knee, ankle, shoulder or other.</label>
					<input type="radio" class="s1Radios" name="q6" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q6" value="No">No

					<label for="q7">7: Has your doctor ever said that you should only do medically supervised physical activity?</label>
					<input type="radio" class="s1Radios" name="q7" required value="Yes">Yes
					<input type="radio" class="s1Radios" name="q7" value="No">No
				</div>
			</fieldset>	
		</section> <!-- end section1 -->

		<section id="section2" style="display:none">
			<fieldset>
				<legend>SECTION 2 - CHRONIC MEDICAL CONDITIONS</legend>
				<p>Please read the questions below carefully and answer each one honestly: check YES or NO.</p>

				<div> <!-- div for question 2.1, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-1">2.1: Do you have Arthritis, Osteoporosis, or Back Problems?</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-1extra');" name="q2-1" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-1extra');" name="q2-1" value="No">No

					<section id="q2-1extra" style="display:none">
						<label for="q2-1a">2.1.a: Do you have difficulty controlling your condition with medications or other
												physician-prescribed therapies? (Answer NO if you are not currently taking
												medications or other treatments)</label>
						<input type="radio" name="q2-1a" required value="Yes">Yes
						<input type="radio" name="q2-1a" value="No">No

						<label for="q2-1b">2.1.b: Do you have joint problems causing pain, a recent fracture or fracture caused
											by osteoporosis or cancer, displaced vertebra (e.g., spondylolisthesis), and/
											or spondylolysis/pars defect (a crack in the bony ring on the back of the spinal
											column)?</label>
						<input type="radio" name="q2-1b" required value="Yes">Yes
						<input type="radio" name="q2-1b" value="No">No

						<label for="q2-1c">2.1.c: Have you had steroid injections or taken steroid tablets regularly for more than 3 months?</label>
						<input type="radio" name="q2-1c" required value="Yes">Yes
						<input type="radio" name="q2-1c" value="No">No
					</section>
				</div> <!-- end div for question 2.1 -->

				<div> <!-- div for question 2.2, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-2">2.2: Do you have Cancer of any kind?</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-2extra');" name="q2-2" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-2extra');" name="q2-2" value="No">No

					<section id="q2-2extra" style="display:none">
						<label for="q2-2a">2.2.a: Does your cancer diagnosis include any of the following types: lung/bronchogenic,
											multiple myeloma (cancer of plasma cells), head, and neck?</label>
						<input type="radio" name="q2-2a" required value="Yes">Yes
						<input type="radio" name="q2-2a" value="No">No

						<label for="q2-2b">2.2.b: Are you currently receiving cancer therapy (such as chemotherapy or radiotherapy)?</label>
						<input type="radio" name="q2-2b" required value="Yes">Yes
						<input type="radio" name="q2-2b" value="No">No
					</section>
				</div> <!-- end div for question 2.2 -->

				<div> <!-- div for question 2.3, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-3">2.3: Do you have Heart Disease or Cardiovascular Disease?
										This includes Coronary Artery Disease, High Blood Pressure, Heart Failure, Diagnosed Abnormality of Heart Rhythm</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-3extra');" name="q2-3" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-3extra');" name="q2-3" value="No">No

					<section id="q2-3extra" style="display:none">
						<label for="q2-3a">2.3.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</label>
						<input type="radio" name="q2-3a" required value="Yes">Yes
						<input type="radio" name="q2-3a" value="No">No

						<label for="q2-3b">2.3.b: Do you have an irregular heart beat that requires medical management?
											(e.g. atrial fibrillation, premature ventricular contraction)</label>
						<input type="radio" name="q2-3b" required value="Yes">Yes
						<input type="radio" name="q2-3b" value="No">No

						<label for="q2-3c">2.3.c: Do you have chronic heart failure?</label>
						<input type="radio" name="q2-3c" required value="Yes">Yes
						<input type="radio" name="q2-3c" value="No">No

						<label for="q2-3d">2.3.d: Do you have a resting blood pressure equal to or greater than 160/90 mmHg with or
											without medication? (Answer YES if you do not know your resting blood pressure)</label>
						<input type="radio" name="q2-3d" required value="Yes">Yes
						<input type="radio" name="q2-3d" value="No">No

						<label for="q2-3e">2.3.e: Do you have diagnosed coronary artery (cardiovascular) disease and have not
											participated in regular physical activity in the last 2 months?</label>
						<input type="radio" name="q2-3e" required value="Yes">Yes
						<input type="radio" name="q2-3e" value="No">No
					</section>
				</div> <!-- end div for question 2.3 -->

				<div> <!-- div for question 2.4, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-4">2.4: Do you have any Metabolic Conditions? This includes Type 1 Diabetes, Type 2 Diabetes, Pre-Diabetes</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-4extra');" name="q2-4" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-4extra');" name="q2-4" value="No">No

					<section id="q2-4extra" style="display:none">
						<label for="q2-4a">2.4.a: Is your blood sugar often above 13.0 mmol/L? (Answer YES if you are not sure)</label>
						<input type="radio" name="q2-4a" required value="Yes">Yes
						<input type="radio" name="q2-4a" value="No">No

						<label for="q2-4b">2.4.b: Do you have any signs or symptoms of diabetes complications such as heart
											or vascular disease and/or complications affecting your eyes, kidneys, and the
											sensation in your toes and feet?</label>
						<input type="radio" name="q2-4b" required value="Yes">Yes
						<input type="radio" name="q2-4b" value="No">No

						<label for="q2-4c">2.4.c: Do you have other metabolic conditions (such as thyroid disorders, pregnancyrelated
											diabetes, chronic kidney disease, liver problems)?</label>
						<input type="radio" name="q2-4c" required value="Yes">Yes
						<input type="radio" name="q2-4c" value="No">No
					</section>
				</div> <!-- end div for question 2.4 -->

				<div> <!-- div for question 2.5, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-5">2.5: Do you have any Mental Health Problems or Learning Difficulties?
										This includes Alzheimer’s, Dementia, Depression, Anxiety Disorder, Eating Disorder,
										Psychotic Disorder, Intellectual Disability, Down Syndrome)</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-5extra');" name="q2-5" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-5extra');" name="q2-5" value="No">No

					<section id="q2-5extra" style="display:none">
						<label for="q2-5a">2.5.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking
											medications or other treatments)</label>
						<input type="radio" name="q2-5a" required value="Yes">Yes
						<input type="radio" name="q2-5a" value="No">No

						<label for="q2-5b">2.5.b: Do you also have back problems affecting nerves or muscles?</label>
						<input type="radio" name="q2-5b" required value="Yes">Yes
						<input type="radio" name="q2-5b" value="No">No
					</section>
				</div> <!-- end div for question 2.5 -->

				<div> <!-- div for question 2.6, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-6">2.6: Do you have a Respiratory Disease? This includes Chronic Obstructive 
										Pulmonary Disease, Asthma, Pulmonary High Blood Pressure</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-6extra');" name="q2-6" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-6extra');" name="q2-6" value="No">No

					<section id="q2-6extra" style="display:none">
						<label for="q2-6a">2.6.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</label>
						<input type="radio" name="q2-6a" required value="Yes">Yes
						<input type="radio" name="q2-6a" value="No">No

						<label for="q2-6b">2.6.b: Has your doctor ever said your blood oxygen level is low at rest or during exercise
											and/or that you require supplemental oxygen therapy?</label>
						<input type="radio" name="q2-6b" required value="Yes">Yes
						<input type="radio" name="q2-6b" value="No">No

						<label for="q2-6c">2.6.c: If asthmatic, do you currently have symptoms of chest tightness, wheezing, laboured
											breathing, consistent cough (more than 2 days/week), or have you used your rescue
											medication more than twice in the last week?</label>
						<input type="radio" name="q2-6c" required value="Yes">Yes
						<input type="radio" name="q2-6c" value="No">No

						<label for="q2-6d">2.6.d: Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?</label>
						<input type="radio" name="q2-6d" required value="Yes">Yes
						<input type="radio" name="q2-6d" value="No">No
					</section>
				</div> <!-- end div for question 2.6 -->

				<div> <!-- div for question 2.7, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-7">2.7: Do you have a Spinal Cord Injury? This includes Tetraplegia and Paraplegia</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-7extra');" name="q2-7" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-7extra');" name="q2-7" value="No">No

					<section id="q2-7extra" style="display:none">
						<label for="q2-7a">2.7.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</label>
						<input type="radio" name="q2-7a" required value="Yes">Yes
						<input type="radio" name="q2-7a" value="No">No

						<label for="q2-7b">2.7.b: Do you commonly exhibit low resting blood pressure significant enough to cause
											dizziness, light-headedness, and/or fainting?</label>
						<input type="radio" name="q2-7b" required value="Yes">Yes
						<input type="radio" name="q2-7b" value="No">No

						<label for="q2-7c">2.7.c: Has your physician indicated that you exhibit sudden bouts of high blood pressure
											(known as Autonomic Dysreflexia)?</label>
						<input type="radio" name="q2-7c" required value="Yes">Yes
						<input type="radio" name="q2-7c" value="No">No
					</section>
				</div> <!-- end div for question 2.7 -->

				<div> <!-- div for question 2.8, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-8">2.8: Have you had a Stroke? This includes Transient Ischemic Attack (TIA) or Cerebrovascular Event</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-8extra');" name="q2-8" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-8extra');" name="q2-8" value="No">No

					<section id="q2-8extra" style="display:none">
						<label for="q2-8a">2.8.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</label>
						<input type="radio" name="q2-8a" required value="Yes">Yes
						<input type="radio" name="q2-8a" value="No">No

						<label for="q2-8b">2.8.b: Do you have any impairment in walking or mobility?</label>
						<input type="radio" name="q2-8b" required value="Yes">Yes
						<input type="radio" name="q2-8b" value="No">No

						<label for="q2-8c">2.8.c: Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?</label>
						<input type="radio" name="q2-8c" required value="Yes">Yes
						<input type="radio" name="q2-8c" value="No">No
					</section>
				</div> <!-- end div for question 2.8 -->

				<div> <!-- div for question 2.9, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
					<label for="q2-9">2.9: Do you have any other medical condition not listed above or do you live with two chronic conditions?</label>
					<input type="radio" onclick="s2RadiosClick(this, 'q2-9extra');" name="q2-9" required value="Yes">Yes
					<input type="radio" onclick="s2RadiosClick(this, 'q2-9extra');" name="q2-9" value="No">No

					<section id="q2-9extra" style="display:none">
						<label for="q2-9a">2.9.a: Have you experienced a blackout, fainted, or lost consciousness as a result of a head
											injury within the last 12 months OR have you had a diagnosed concussion within the last 12 months?</label>
						<input type="radio" name="q2-9a" required value="Yes">Yes
						<input type="radio" name="q2-9a" value="No">No

						<label for="q2-9b">2.9.b: Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?</label>
						<input type="radio" name="q2-9b" required value="Yes">Yes
						<input type="radio" name="q2-9b" value="No">No

						<label for="q2-9c">2.9.c: Do you currently live with two chronic conditions?</label>
						<input type="radio" name="q2-9c" required value="Yes">Yes
						<input type="radio" name="q2-9c" value="No">No
					</section>
				</div> <!-- end div for question 2.9 -->
			</fieldset>
		</section> <!-- end section2 -->

		<section>
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
				<label for="fullName">Full Name</label>
				<input type="text" class="" name="fullName" placeholder="Full Name" required value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['fullName']);} ?>">

				<label for="dateCompleted">Date Completed</label>
				<input type="date" class="" name="dateCompleted" required value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dateCompleted']);} ?>">

				<label for="signature">Signature (type your full name)</label>
				<input type="text" class="" name="signature" required placeholder="Sign here" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['signature']);} ?>">

				<label for="guardianSignature">Parent/Guardian/Care Provider Signature (If applicable)</label>
				<input type="text" class="" name="guardianSignature" placeholder="Sign here" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['guardianSignature']);} ?>">
			</fieldset>
		</section>
	</section>
	<input class="btn-primary" type="submit" name="submitParQ">
</form> <!-- end Form -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
<script>

	$(".s1Radios").change(function () {
		var show = false;
		$(".s1Radios").each(function () {
			if ($(this).is(":checked") && $(this).val() == "Yes") {
				show = true;
				return false;
			}			
		});
		if (show) {
			$("#section2").show("slow");			
		}
		else {
			$("#section2").hide("slow");
		}

	});

	function s2RadiosClick(radioElement, divID) {
		if ($(radioElement).val() === "Yes") {
			$("#"+ divID).show("slow");
		}
		else {
			$("#"+ divID).hide("slow");
		}
	}

</script>

<?php if(isset($parQreturn) && !empty($parQreturn)){?>
    
    <script>
    $(document).ready(function (){
      $("#parQmessage").addClass('alert-danger');
      $("#parQmessage").html('<?= $return;?>');
      $("#parQmessage").show();
    });
    </script>
    <?php } ?>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
<?php require_once"footer.php";?>