<?php
	require_once"header.php";
 	if (isset($_POST['submitParQ']))
    {
      //echo var_dump($_POST); //DEBUG
      $parQvalidator = new FormsModel($_POST);
      $parQreturn = $parQvalidator->ValidateParQ();
    } 
?>
<div class="background">
<form method="post" class="form-vertical">
	<h1><strong>Par-Q Form</strong></h1>
	<div>
		<h2>The Physical Activity Readiness Questionnaire for Everyone</h2>
		<p>Regular physical activity is fun and healthy, and more people should become more physically active every day of the week.
Being more physically active is very safe for MOST people. This questionnaire will tell you whether it is necessary for you to
seek further advice from your doctor OR a qualified exercise professional before becoming more physically active.</p>
		<div id="parQmessage" style="display:none"></div>
		<div id="section1">
			
			<fieldset>
				<legend>SECTION 1 - GENERAL HEALTH</legend>
				<p>Please read the 7 questions below carefully and answer each one honestly: check YES or NO.</p>
				<div id="s1RadioGroup">
                    <div>
                        <label for="q1-1"><p>1: Has your doctor ever said that you have a heart condition OR high blood pressure?</p></label>
                        <div><input type="radio" class="s1Radios" name="q1-1" required value="Yes">Yes</div>
					    <div><input type="radio" class="s1Radios" name="q1-1" value="No">No</div>
                    </div>
                    
                    <div>                    
					   <label for="q1-2"><p>2: Do you feel pain in your chest at rest, during your daily activities of living, OR when you do physical activity?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1-2" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-2" value="No">No</div>
                    </div>
                    
                    <div>
					   <label for="q1-3"><p>3: Do you lose balance because of dizziness OR have you lost consciousness in the last 12 months? 
									Please answer NO if your dizziness was associated with over-breathing (including during vigorous exercise):</p></label>
                       <div><input type="radio" class="s1Radios" name="q1-3" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-3" value="No">No</div>
                    </div>
                    
                    <div>
					   <label for="q1-4"><p>4: Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1-4" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-4" value="No">No</div>
                    </div>
                    
                    <div>
					   <label for="q1-5"><p>5: Are you currently taking prescribed medications for a chronic medical condition?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1-5" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-5" value="No">No</div>
                    </div>
                    
                    <div>
					   <label for="q1-6"><p>6: Do you have a bone or joint problem that could be made worse by becoming more physically active? 
									Please answer NO if you had a joint problem in the past, but it does not limit your current ability to be physically active. 
									For example, knee, ankle, shoulder or other.</p></label>
					   <div><input type="radio" class="s1Radios" name="q1-6" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-6" value="No">No</div>
                    </div>
                    
                    <div>
					   <label for="q1-7"><p>7: Has your doctor ever said that you should only do medically supervised physical activity?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1-7" required value="Yes">Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1-7" value="No">No</div>
                    </div>
				</div>
			</fieldset>	
		</div> <!-- end section1 -->
		<br><hr><br>
		<div id="section2" style="display:none">
			<fieldset>
                <legend>SECTION 2 - CHRONIC MEDICAL CONDITIONS</legend>
				<p>Please read the questions below carefully and answer each one honestly: check YES or NO.</p>

				<div> <!-- div for question 2.1, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
                        <label for="q2-1"><p>2.1: Do you have Arthritis, Osteoporosis, or Back Problems?</p></label>
					      <div><input type="radio" onclick="s2RadiosClick(this, 'q2-1extra');" name="q2-1" value="Yes">Yes</div>
					      <div><input type="radio" onclick="s2RadiosClick(this, 'q2-1extra');" name="q2-1" value="No">No</div>
                    </div>
					<div class="subQuestions" id="q2-1extra" style="display:none">
                        <div>
						      <label for="q2-1a"><p>2.1.a: Do you have difficulty controlling your condition with medications or other
												physician-prescribed therapies? (Answer NO if you are not currently taking
												medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-1a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-1a" value="No">No</div>
                        </div>
                        
                        <div>
						  <label for="q2-1b"><p>2.1.b: Do you have joint problems causing pain, a recent fracture or fracture caused
											by osteoporosis or cancer, displaced vertebra (e.g., spondylolisthesis), and/
											or spondylolysis/pars defect (a crack in the bony ring on the back of the spinal
											column)?</p></label>
						  <div><input type="radio" name="q2-1b" value="Yes">Yes</div>  
						  <div><input type="radio" name="q2-1b" value="No">No</div> 
                        </div>
                        
                        <div>
						  <label for="q2-1c"><p>2.1.c: Have you had steroid injections or taken steroid tablets regularly for more than 3 months?</p></label>
						  <div><input type="radio" name="q2-1c" value="Yes">Yes</div>
						  <div><input type="radio" name="q2-1c" value="No">No</div>
                        </div>
                        
					</div>
				</div> <!-- end div for question 2.1 -->

				<div> <!-- div for question 2.2, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2-2"><p>2.2: Do you have Cancer of any kind?</p></label>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-2extra');" name="q2-2" value="Yes">Yes</div>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-2extra');" name="q2-2" value="No">No</div>
                    </div>
                    
					<div class="subQuestions" id="q2-2extra" style="display:none">
                        <div>
						  <label for="q2-2a"><p>2.2.a: Does your cancer diagnosis include any of the following types: lung/bronchogenic,
											multiple myeloma (cancer of plasma cells), head, and neck?</p></label>
						  <div><input type="radio" name="q2-2a" value="Yes">Yes</div>
						  <div><input type="radio" name="q2-2a" value="No">No</div>
                        </div>
                       
                        <div>
						  <label for="q2-2b"><p>2.2.b: Are you currently receiving cancer therapy (such as chemotherapy or radiotherapy)?</p></label>
						  <div><input type="radio" name="q2-2b" value="Yes">Yes</div>
						  <div><input type="radio" name="q2-2b" value="No">No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.2 -->

				<div> <!-- div for question 2.3, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2-3"><p>2.3: Do you have Heart Disease or Cardiovascular Disease?
										This includes Coronary Artery Disease, High Blood Pressure, Heart Failure, Diagnosed Abnormality of Heart Rhythm</p></label>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-3extra');" name="q2-3" value="Yes">Yes</div>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-3extra');" name="q2-3" value="No">No</div>
                    </div>
                    
					<div class="subQuestions" id="q2-3extra" style="display:none">
                        <div>
						      <label for="q2-3a"><p>2.3.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-3a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-3a" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-3b"><p>2.3.b: Do you have an irregular heart beat that requires medical management?
											(e.g. atrial fibrillation, premature ventricular contraction)</p></label>
						      <div><input type="radio" name="q2-3b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-3b" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-3c"><p>2.3.c: Do you have chronic heart failure?</p></label>
						      <div><input type="radio" name="q2-3c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-3c" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-3d"><p>2.3.d: Do you have a resting blood pressure equal to or greater than 160/90 mmHg with or
											without medication? (Answer YES if you do not know your resting blood pressure)</p></label>
						      <div><input type="radio" name="q2-3d" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-3d" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-3e"><p>2.3.e: Do you have diagnosed coronary artery (cardiovascular) disease and have not
											participated in regular physical activity in the last 2 months?</p></label>
						      <div><input type="radio" name="q2-3e" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-3e" value="No">No</div>
                        </div>      
					</div>
				</div> <!-- end div for question 2.3 -->

				<div> <!-- div for question 2.4, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					<label for="q2-4"><p>2.4: Do you have any Metabolic Conditions? This includes Type 1 Diabetes, Type 2 Diabetes, Pre-Diabetes</p></label>
					<div><input type="radio" onclick="s2RadiosClick(this, 'q2-4extra');" name="q2-4" value="Yes">Yes</div>
					<div><input type="radio" onclick="s2RadiosClick(this, 'q2-4extra');" name="q2-4" value="No">No</div>
                    </div>
					<div class="subQuestions" id="q2-4extra" style="display:none">
                        <div>
						      <label for="q2-4a"><p>2.4.a: Is your blood sugar often above 13.0 mmol/L? (Answer YES if you are not sure)</p></label>
						      <div><input type="radio" name="q2-4a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-4a" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-4b"><p>2.4.b: Do you have any signs or symptoms of diabetes complications such as heart
											or vascular disease and/or complications affecting your eyes, kidneys, and the
											sensation in your toes and feet?</p></label>
						      <div><input type="radio" name="q2-4b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-4b" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-4c"><p>2.4.c: Do you have other metabolic conditions (such as thyroid disorders, pregnancyrelated
											diabetes, chronic kidney disease, liver problems)?</p></label>
						      <div><input type="radio" name="q2-4c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-4c" value="No">No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.4 -->

				<div> <!-- div for question 2.5, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2-5"><p>2.5: Do you have any Mental Health Problems or Learning Difficulties?
										This includes Alzheimer’s, Dementia, Depression, Anxiety Disorder, Eating Disorder,
										Psychotic Disorder, Intellectual Disability, Down Syndrome)</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-5extra');" name="q2-5" value="Yes">Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-5extra');" name="q2-5" value="No">No</div>
                    </div>
                    
					<div class="subQuestions" id="q2-5extra" style="display:none">
                        <div>
						      <label for="q2-5a"><p>2.5.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking
											medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-5a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-5a" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-5b"><p>2.5.b: Do you also have back problems affecting nerves or muscles?</p></label>
						      <div><input type="radio" name="q2-5b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-5b" value="No">No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.5 -->

				<div> <!-- div for question 2.6, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2-6"><p>2.6: Do you have a Respiratory Disease? This includes Chronic Obstructive 
										Pulmonary Disease, Asthma, Pulmonary High Blood Pressure</p></label>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-6extra');" name="q2-6" value="Yes">Yes</div>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2-6extra');" name="q2-6" value="No">No</div>
                    </div>

					<div class="subQuestions" id="q2-6extra" style="display:none">
                        <div>
						      <label for="q2-6a"><p>2.6.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-6a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-6a" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-6b"><p>2.6.b: Has your doctor ever said your blood oxygen level is low at rest or during exercise
											and/or that you require supplemental oxygen therapy?</p></label>
						      <div><input type="radio" name="q2-6b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-6b" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-6c"><p>2.6.c: If asthmatic, do you currently have symptoms of chest tightness, wheezing, laboured
											breathing, consistent cough (more than 2 days/week), or have you used your rescue
											medication more than twice in the last week?</p></label>
						      <div><input type="radio" name="q2-6c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-6c" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-6d"><p>2.6.d: Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?</p></label>
						      <div><input type="radio" name="q2-6d" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-6d" value="No">No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.6 -->

				<div> <!-- div for question 2.7, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2-7"><p>2.7: Do you have a Spinal Cord Injury? This includes Tetraplegia and Paraplegia</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-7extra');" name="q2-7" value="Yes">Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-7extra');" name="q2-7" value="No">No</div>
                    </div>
					<div class="subQuestions" id="q2-7extra" style="display:none">
                        <div>
						      <label for="q2-7a"><p>2.7.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-7a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-7a" value="No">No</div>
                        </div>       
                        <div>
						      <label for="q2-7b"><p>2.7.b: Do you commonly exhibit low resting blood pressure significant enough to cause
											dizziness, light-headedness, and/or fainting?</p></label>
						      <div><input type="radio" name="q2-7b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-7b" value="No">No</div>
                        </div>     
                        <div>
						      <label for="q2-7c"><p>2.7.c: Has your physician indicated that you exhibit sudden bouts of high blood pressure
											(known as Autonomic Dysreflexia)?</p></label>
						      <div><input type="radio" name="q2-7c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-7c" value="No">No</div>
                       </div>      
					</div>
				</div> <!-- end div for question 2.7 -->

				<div> <!-- div for question 2.8, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2-8"><p>2.8: Have you had a Stroke? This includes Transient Ischemic Attack (TIA) or Cerebrovascular Event</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-8extra');" name="q2-8" value="Yes">Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-8extra');" name="q2-8" value="No">No</div>
                    </div>
					<div class="subQuestions" id="q2-8extra" style="display:none">
                        <div>
						      <label for="q2-8a"><p>2.8.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div><input type="radio" name="q2-8a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-8a" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-8b"><p>2.8.b: Do you have any impairment in walking or mobility?</p></label>
						      <div><input type="radio" name="q2-8b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-8b" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-8c"><p>2.8.c: Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?</p></label>
						      <div><input type="radio" name="q2-8c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-8c" value="No">No</div>
                        </div>    
					</div>
				</div> <!-- end div for question 2.8 -->

				<div> <!-- div for question 2.9, the sub section with id: q2.*extra should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2-9"><p>2.9: Do you have any other medical condition not listed above or do you live with two chronic conditions?</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-9extra');" name="q2-9" value="Yes">Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2-9extra');" name="q2-9" value="No">No</div>
                    </div>
                    
					<div class="subQuestions" id="q2-9extra" style="display:none">
                        <div>
						      <label for="q2-9a"><p>2.9.a: Have you experienced a blackout, fainted, or lost consciousness as a result of a head
											injury within the last 12 months OR have you had a diagnosed concussion within the last 12 months?</p></label>
						      <div><input type="radio" name="q2-9a" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-9a" value="No">No</div>
                        </div>
                       <div> 
						      <label for="q2-9b"><p>2.9.b: Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?</p></label>
						      <div><input type="radio" name="q2-9b" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-9b" value="No">No</div>
                        </div>
                        <div>
						      <label for="q2-9c"><p>2.9.c: Do you currently live with two chronic conditions?</p></label>
						      <div><input type="radio" name="q2-9c" value="Yes">Yes</div>
						      <div><input type="radio" name="q2-9c" value="No">No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.9 -->
			</fieldset>
		</div> <!-- end section2 -->
		<br><hr><br>
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
                <div>
                    <label for="fullName"><p>Full Name</p></label>
                    <input type="text" class="" name="fullName" placeholder="Full Name" required value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['fullName']);} ?>"></div>
                    
				   <div><label for="dateCompleted"><p>Date Completed</p></label>
				    <input type="date" class="" name="dateCompleted" required value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dateCompleted']);} ?>"></div>
                <div>
				    <label for="signature"><p>Signature (type your full name)</p></label>
				    <input type="text" class="" name="signature" required placeholder="Sign here" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['signature']);} ?>"></div>
                <div>
				    <label for="guardianSignature"><p>Parent/Guardian/Care Provider Signature (If applicable)</p></label>
                    <input type="text" class="" name="guardianSignature" placeholder="Sign here" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['guardianSignature']);} ?>"></div>
			</fieldset>
		</div>
	</div>
    <button class="btn-primary" type="submit" name="submitParQ">Submit</button>
</form> <!-- end Form -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
<script>
	/* Loops through section 1 answers and decide if section 2 should be shown/hidden */
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
	/* Generic function for all section 2 questions, if yes show sub-questions, if no hide */
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