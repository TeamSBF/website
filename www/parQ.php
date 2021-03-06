
<?php

 	if (isset($_POST['submitParQ']))
    {
    	if ($user)
    	{
    		$_POST['userID'] = $user->id;
		    print_r($_POST);
		    $parQvalidator = new FormsModel($_POST);
		    $parQreturn = $parQvalidator->validateParQ();
		    print_r($parQreturn);
    	}	
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
		<div id="section1">
			
			<fieldset>
				<legend>SECTION 1 - GENERAL HEALTH</legend>
				<p>Please read the 7 questions below carefully and answer each one honestly: check YES or NO.</p>
				<div id="s1RadioGroup">
                    <div>
                        <label for="q1_1"><p>1: Has your doctor ever said that you have a heart condition OR high blood pressure?</p></label>
                        <div><input type="radio" class="s1Radios" name="q1_1" <?php if (isset($_POST['q1_1']) && $_POST['q1_1'] == 1) {echo "checked";}?> required value=1>Yes</div>
					    <div><input type="radio" class="s1Radios" name="q1_1" <?php if (isset($_POST['q1_1']) && $_POST['q1_1'] == 0) {echo "checked";}?> value=0>No</div>
                    </div>

                    <div>                    
					   <label for="q1_2"><p>2: Do you feel pain in your chest at rest, during your daily activities of living, OR when you do physical activity?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1_2" <?php if (isset($_POST['q1_2']) && $_POST['q1_2'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_2" <?php if (isset($_POST['q1_2']) && $_POST['q1_2'] == 0) echo "checked";?> value=0>No</div>
                    </div>
                    
                    <div>
					   <label for="q1_3"><p>3: Do you lose balance because of dizziness OR have you lost consciousness in the last 12 months? 
									Please answer NO if your dizziness was associated with over_breathing (including during vigorous exercise):</p></label>
                       <div><input type="radio" class="s1Radios" name="q1_3" <?php if (isset($_POST['q1_3']) && $_POST['q1_3'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_3" <?php if (isset($_POST['q1_3']) && $_POST['q1_3'] == 0) echo "checked";?>  value=0>No</div>
                    </div>
                    
                    <div>
					   <label for="q1_4"><p>4: Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1_4" <?php if (isset($_POST['q1_4']) && $_POST['q1_4'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_4" <?php if (isset($_POST['q1_4']) && $_POST['q1_4'] == 0) echo "checked";?>  value=0>No</div>
                    </div>
                    
                    <div>
					   <label for="q1_5"><p>5: Are you currently taking prescribed medications for a chronic medical condition?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1_5" <?php if (isset($_POST['q1_5']) && $_POST['q1_5'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_5" <?php if (isset($_POST['q1_5']) && $_POST['q1_5'] == 0) echo "checked";?>  value=0>No</div>
                    </div>
                    
                    <div>
					   <label for="q1_6"><p>6: Do you have a bone or joint problem that could be made worse by becoming more physically active? 
									Please answer NO if you had a joint problem in the past, but it does not limit your current ability to be physically active. 
									For example, knee, ankle, shoulder or other.</p></label>
					   <div><input type="radio" class="s1Radios" name="q1_6" <?php if (isset($_POST['q1_6']) && $_POST['q1_6'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_6" <?php if (isset($_POST['q1_6']) && $_POST['q1_6'] == 0) echo "checked";?>  value=0>No</div>
                    </div>
                    
                    <div>
					   <label for="q1_7"><p>7: Has your doctor ever said that you should only do medically supervised physical activity?</p></label>
					   <div><input type="radio" class="s1Radios" name="q1_7" <?php if (isset($_POST['q1_7']) && $_POST['q1_7'] == 1) echo "checked";?> required value=1>Yes</div>
					   <div><input type="radio" class="s1Radios" name="q1_7" <?php if (isset($_POST['q1_7']) && $_POST['q1_7'] == 0) echo "checked";?> value=0>No</div>
                    </div>
				</div>
			</fieldset>	
		</div> <!-- end section1 -->
		<br><br>
		<div id="section2" style="display:none">
			<fieldset>
				<legend>SECTION 2 - CHRONIC MEDICAL CONDITIONS</legend>
				<p>Please read the questions below carefully and answer each one honestly: check YES or NO.</p>

				<div> <!-- div for question 2.1, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
                        <label for="q2_1"><p>2.1: Do you have Arthritis, Osteoporosis, or Back Problems?</p></label>
					      <div><input type="radio" onclick="s2RadiosClick(this, 'q2_1');" name="q2_1" <?php if (isset($_POST['q2_1']) && $_POST['q2_1'] == 1) echo "checked";?> value=1>Yes</div>
					      <div><input type="radio" onclick="s2RadiosClick(this, 'q2_1');" name="q2_1" <?php if (isset($_POST['q2_1']) && $_POST['q2_1'] == 0) echo "checked";?> value=0>No</div>
                    </div>
					<div class="subQuestions" id="q2_1" <?php if (!isset($_POST['q2_1']) || $_POST['q2_1'] === 0) {echo 'style="display:none"';}?> >
                        <div>
						      <label for="q2_1_1"><p class="question">2.1.a: Do you have difficulty controlling your condition with medications or other
												physician_prescribed therapies? (Answer NO if you are not currently taking
												medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_1_1" <?php if (isset($_POST['q2_1_1']) && $_POST['q2_1_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_1_1" <?php if (isset($_POST['q2_1_1']) && $_POST['q2_1_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        
                        <div>
						  <label for="q2_1_2"><p class="question">2.1.b: Do you have joint problems causing pain, a recent fracture or fracture caused
											by osteoporosis or cancer, displaced vertebra (e.g., spondylolisthesis), and/
											or spondylolysis/pars defect (a crack in the bony ring on the back of the spinal
											column)?</p></label>
						  <div class="input"><input type="radio" name="q2_1_2" <?php if (isset($_POST['q2_1_2']) && $_POST['q2_1_2'] == 1) echo "checked";?> value=1>Yes</div>  
						  <div class="input"><input type="radio" name="q2_1_2" <?php if (isset($_POST['q2_1_2']) && $_POST['q2_1_2'] == 0) echo "checked";?> value=0>No</div> 
                        </div>
                        
                        <div>
						  <label for="q2_1_3"><p class="question">2.1.c: Have you had steroid injections or taken steroid tablets regularly for more than 3 months?</p></label>
						  <div class="input"><input type="radio" name="q2_1_3" <?php if (isset($_POST['q2_1_3']) && $_POST['q2_1_3'] == 1) echo "checked";?> value=1>Yes</div>
						  <div class="input"><input type="radio" name="q2_1_3" <?php if (isset($_POST['q2_1_3']) && $_POST['q2_1_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        
					</div>
				</div> <!-- end div for question 2.1 -->

				<div> <!-- div for question 2.2, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2_2"><p class="question">2.2: Do you have Cancer of any kind?</p></label>
					   <div class="input"><input type="radio" onclick="s2RadiosClick(this, 'q2_2');" name="q2_2" <?php if (isset($_POST['q2_2']) && $_POST['q2_2'] == 1) echo "checked";?> value=1>Yes</div>
					   <div class="input"><input type="radio" onclick="s2RadiosClick(this, 'q2_2');" name="q2_2" <?php if (isset($_POST['q2_2']) && $_POST['q2_2'] == 0) echo "checked";?> value=0>No</div>
                    </div>
                    
					<div class="subQuestions" id="q2_2" <?php if (!isset($_POST['q2_2']) || $_POST['q2_2'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						  <label for="q2_2_1"><p class="question">2.2.a: Does your cancer diagnosis include any of the following types: lung/bronchogenic,
											multiple myeloma (cancer of plasma cells), head, and neck?</p></label>
						  <div class="input"><input type="radio" name="q2_2_1" <?php if (isset($_POST['q2_2_1']) && $_POST['q2_2_1'] == 1) echo "checked";?> value=1>Yes</div>
						  <div class="input"><input type="radio" name="q2_2_1" <?php if (isset($_POST['q2_2_1']) && $_POST['q2_2_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                       
                        <div>
						  <label for="q2_2_2"><p class="question">2.2.b: Are you currently receiving cancer therapy (such as chemotherapy or radiotherapy)?</p></label>
						  <div class="input"><input type="radio" name="q2_2_2" <?php if (isset($_POST['q2_2_2']) && $_POST['q2_2_2'] == 1) echo "checked";?> value=1>Yes</div>
						  <div class="input"><input type="radio" name="q2_2_2" <?php if (isset($_POST['q2_2_2']) && $_POST['q2_2_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.2 -->

				<div> <!-- div for question 2.3, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2_3"><p class="question">2.3: Do you have Heart Disease or Cardiovascular Disease?
										This includes Coronary Artery Disease, High Blood Pressure, Heart Failure, Diagnosed Abnormality of Heart Rhythm</p></label>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2_3');" name="q2_3" <?php if (isset($_POST['q2_3']) && $_POST['q2_3'] == 1) echo "checked";?> value=1>Yes</div>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2_3');" name="q2_3" <?php if (isset($_POST['q2_3']) && $_POST['q2_3'] == 0) echo "checked";?> value=0>No</div>
                    </div>
                    
					<div class="subQuestions" id="q2_3" <?php if (!isset($_POST['q2_3']) || $_POST['q2_3'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_3_1"><p class="question">2.3.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_3_1" <?php if (isset($_POST['q2_3_1']) && $_POST['q2_3_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_3_1" <?php if (isset($_POST['q2_3_1']) && $_POST['q2_3_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_3_2"><p class="question">2.3.b: Do you have an irregular heart beat that requires medical management?
											(e.g. atrial fibrillation, premature ventricular contraction)</p></label>
						      <div class="input"><input type="radio" name="q2_3_2" <?php if (isset($_POST['q2_3_2']) && $_POST['q2_3_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_3_2" <?php if (isset($_POST['q2_3_2']) && $_POST['q2_3_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_3_3"><p class="question">2.3.c: Do you have chronic heart failure?</p></label>
						      <div class="input"><input type="radio" name="q2_3_3" <?php if (isset($_POST['q2_3_3']) && $_POST['q2_3_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_3_3" <?php if (isset($_POST['q2_3_3']) && $_POST['q2_3_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_3_4"><p class="question">2.3.d: Do you have a resting blood pressure equal to or greater than 160/90 mmHg with or
											without medication? (Answer YES if you do not know your resting blood pressure)</p></label>
						      <div class="input"><input type="radio" name="q2_3_4" <?php if (isset($_POST['q2_3_4']) && $_POST['q2_3_4'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_3_4" <?php if (isset($_POST['q2_3_4']) && $_POST['q2_3_4'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_3_5"><p class="question">2.3.e: Do you have diagnosed coronary artery (cardiovascular) disease and have not
											participated in regular physical activity in the last 2 months?</p></label>
						      <div class="input"><input type="radio" name="q2_3_5" <?php if (isset($_POST['q2_3_5']) && $_POST['q2_3_5'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_3_5" <?php if (isset($_POST['q2_3_5']) && $_POST['q2_3_5'] == 0) echo "checked";?> value=0>No</div>
                        </div>      
					</div>
				</div> <!-- end div for question 2.3 -->

				<div> <!-- div for question 2.4, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					<label for="q2-4"><p class="question">2.4: Do you have any Metabolic Conditions? This includes Type 1 Diabetes, Type 2 Diabetes, Pre-Diabetes</p></label>
					<div><input type="radio" onclick="s2RadiosClick(this, 'q2_4');" <?php if (isset($_POST['q2_4']) && $_POST['q2_4'] == 1) echo "checked";?> name="q2_4" value=1>Yes</div>
					<div><input type="radio" onclick="s2RadiosClick(this, 'q2_4');" <?php if (isset($_POST['q2_4']) && $_POST['q2_4'] == 1) echo "checked";?> name="q2_4" value=0>No</div>
                    </div>
					<div class="subQuestions" id="q2_4" <?php if (!isset($_POST['q2_4']) || $_POST['q2_4'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_4_1"><p class="question">2.4.a: Is your blood sugar often above 13.0 mmol/L? (Answer YES if you are not sure)</p></label>
						      <div class="input"><input type="radio" name="q2_4_1" <?php if (isset($_POST['q2_4_1']) && $_POST['q2_4_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_4_1" <?php if (isset($_POST['q2_4_1']) && $_POST['q2_4_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_4_2"><p class="question">2.4.b: Do you have any signs or symptoms of diabetes complications such as heart
											or vascular disease and/or complications affecting your eyes, kidneys, and the
											sensation in your toes and feet?</p></label>
						      <div><input class="input" type="radio" name="q2_4_2" <?php if (isset($_POST['q2_4_2']) && $_POST['q2_4_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div><input class="input" type="radio" name="q2_4_2" <?php if (isset($_POST['q2_4_2']) && $_POST['q2_4_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_4_3"><p class="question">2.4.c: Do you have other metabolic conditions (such as thyroid disorders, pregnancyrelated
											diabetes, chronic kidney disease, liver problems)?</p></label>
						      <div class="input"><input type="radio" name="q2_4_3" <?php if (isset($_POST['q2_4_3']) && $_POST['q2_4_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_4_3" <?php if (isset($_POST['q2_4_3']) && $_POST['q2_4_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.4 -->

				<div> <!-- div for question 2.5, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2_5"><p class="question">2.5: Do you have any Mental Health Problems or Learning Difficulties?
										This includes Alzheimer’s, Dementia, Depression, Anxiety Disorder, Eating Disorder,
										Psychotic Disorder, Intellectual Disability, Down Syndrome)</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_5');" name="q2_5" <?php if (isset($_POST['q2_5']) && $_POST['q2_5'] == 1) echo "checked";?> value=1>Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_5');" name="q2_5" <?php if (isset($_POST['q2_5']) && $_POST['q2_5'] == 0) echo "checked";?> value=0>No</div>
                    </div>
                    
					<div class="subQuestions" id="q2_5" <?php if (!isset($_POST['q2_5']) || $_POST['q2_5'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_5_1"><p class="question">2.5.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking
											medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_5_1" <?php if (isset($_POST['q2_5_1']) && $_POST['q2_5_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_5_1" <?php if (isset($_POST['q2_5_1']) && $_POST['q2_5_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_5_2"><p class="question">2.5.b: Do you also have back problems affecting nerves or muscles?</p></label>
						      <div class="input"><input type="radio" name="q2_5_2" <?php if (isset($_POST['q2_5_2']) && $_POST['q2_5_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_5_2" <?php if (isset($_POST['q2_5_2']) && $_POST['q2_5_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.5 -->

				<div> <!-- div for question 2.6, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					   <label for="q2_6"><p class="question">2.6: Do you have a Respiratory Disease? This includes Chronic Obstructive 
										Pulmonary Disease, Asthma, Pulmonary High Blood Pressure</p></label>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2_6');" name="q2_6" <?php if (isset($_POST['q2_6']) && $_POST['q2_6'] == 1) echo "checked";?> value=1>Yes</div>
					   <div><input type="radio" onclick="s2RadiosClick(this, 'q2_6');" name="q2_6" <?php if (isset($_POST['q2_6']) && $_POST['q2_6'] == 0) echo "checked";?> value=0>No</div>
                    </div>

					<div class="subQuestions" id="q2_6" <?php if (!isset($_POST['q2_6']) || $_POST['q2_6'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_6_1"><p class="question">2.6.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_6_1" <?php if (isset($_POST['q2_6_1']) && $_POST['q2_6_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_6_1" <?php if (isset($_POST['q2_6_1']) && $_POST['q2_6_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_6_2"><p class="question">2.6.b: Has your doctor ever said your blood oxygen level is low at rest or during exercise
											and/or that you require supplemental oxygen therapy?</p></label>
						      <div class="input"><input type="radio" name="q2_6_2" <?php if (isset($_POST['q2_6_2']) && $_POST['q2_6_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_6_2" <?php if (isset($_POST['q2_6_2']) && $_POST['q2_6_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_6_3"><p class="question">2.6.c: If asthmatic, do you currently have symptoms of chest tightness, wheezing, laboured
											breathing, consistent cough (more than 2 days/week), or have you used your rescue
											medication more than twice in the last week?</p></label>
						      <div class="input"><input type="radio" name="q2_6_3" <?php if (isset($_POST['q2_6_3']) && $_POST['q2_6_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_6_3" <?php if (isset($_POST['q2_6_3']) && $_POST['q2_6_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_6_4"><p class="question">2.6.d: Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?</p></label>
						      <div class="input"><input type="radio" name="q2_6_4" <?php if (isset($_POST['q2_6_4']) && $_POST['q2_6_4'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_6_4" <?php if (isset($_POST['q2_6_4']) && $_POST['q2_6_4'] == 0) echo "checked";?> value=0>No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.6 -->

				<div> <!-- div for question 2.7, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2_7"><p class="question">2.7: Do you have a Spinal Cord Injury? This includes Tetraplegia and Paraplegia</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_7');" name="q2_7" <?php if (isset($_POST['q2_7']) && $_POST['q2_7'] == 1) echo "checked";?> value=1>Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_7');" name="q2_7" <?php if (isset($_POST['q2_7']) && $_POST['q2_7'] == 0) echo "checked";?> value=0>No</div>
                    </div>
					<div class="subQuestions" id="q2_7" <?php if (!isset($_POST['q2_7']) || $_POST['q2_7'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_7_1"><p class="question">2.7.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_7_1" <?php if (isset($_POST['q2_7_1']) && $_POST['q2_7_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_7_1" <?php if (isset($_POST['q2_7_1']) && $_POST['q2_7_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>       
                        <div>
						      <label for="q2_7_2"><p class="question">2.7.b: Do you commonly exhibit low resting blood pressure significant enough to cause
											dizziness, light_headedness, and/or fainting?</p></label>
						      <div class="input"><input type="radio" name="q2_7_2" <?php if (isset($_POST['q2_7_2']) && $_POST['q2_7_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_7_2" <?php if (isset($_POST['q2_7_2']) && $_POST['q2_7_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>     
                        <div>
						      <label for="q2_7_3"><p class="question">2.7.c: Has your physician indicated that you exhibit sudden bouts of high blood pressure
											(known as Autonomic Dysreflexia)?</p></label>
						      <div class="input"><input type="radio" name="q2_7_3" <?php if (isset($_POST['q2_7_3']) && $_POST['q2_7_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_7_3" <?php if (isset($_POST['q2_7_3']) && $_POST['q2_7_3'] == 0) echo "checked";?> value=0>No</div>
                       </div>      
					</div>
				</div> <!-- end div for question 2.7 -->

				<div> <!-- div for question 2.8, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2_8"><p class="question">2.8: Have you had a Stroke? This includes Transient Ischemic Attack (TIA) or Cerebrovascular Event</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_8');" name="q2_8" <?php if (isset($_POST['q2_8']) && $_POST['q2_8'] == 1) echo "checked";?> value=1>Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_8');" name="q2_8" <?php if (isset($_POST['q2_8']) && $_POST['q2_8'] == 0) echo "checked";?> value=0>No</div>
                    </div>
					<div class="subQuestions" id="q2_8" <?php if (!isset($_POST['q2_8']) || $_POST['q2_8'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_8_1"><p class="question">2.8.a: Do you have difficulty controlling your condition with medications or other
											physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)</p></label>
						      <div class="input"><input type="radio" name="q2_8_1" <?php if (isset($_POST['q2_8_1']) && $_POST['q2_8_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_8_1" <?php if (isset($_POST['q2_8_1']) && $_POST['q2_8_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_8_2"><p class="question">2.8.b: Do you have any impairment in walking or mobility?</p></label>
						      <div class="input"><input type="radio" name="q2_8_2" <?php if (isset($_POST['q2_8_2']) && $_POST['q2_8_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_8_2" <?php if (isset($_POST['q2_8_2']) && $_POST['q2_8_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_8_3"><p class="question">2.8.c: Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?</p></label>
						      <div class="input"><input type="radio" name="q2_8_3" <?php if (isset($_POST['q2_8_3']) && $_POST['q2_8_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_8_3" <?php if (isset($_POST['q2_8_3']) && $_POST['q2_8_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>    
					</div>
				</div> <!-- end div for question 2.8 -->

				<div> <!-- div for question 2.9, the sub section with id: q2.* should be indented (see parQ pdf) -->
                    <div>
					       <label for="q2_9"><p class="question">2.9: Do you have any other medical condition not listed above or do you live with two chronic conditions?</p></label>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_9');" name="q2_9" <?php if (isset($_POST['q2_9']) && $_POST['q2_9'] == 1) echo "checked";?> value=1>Yes</div>
					       <div><input type="radio" onclick="s2RadiosClick(this, 'q2_9');" name="q2_9" <?php if (isset($_POST['q2_9']) && $_POST['q2_9'] == 0) echo "checked";?> value=0>No</div>
                    </div>
                    
					<div class="subQuestions" id="q2_9" <?php if (!isset($_POST['q2_9']) || $_POST['q2_9'] === 0) {echo 'style="display:none"';}?>>
                        <div>
						      <label for="q2_9_1"><p class="question">2.9.a: Have you experienced a blackout, fainted, or lost consciousness as a result of a head
											injury within the last 12 months OR have you had a diagnosed concussion within the last 12 months?</p></label>
						      <div class="input"><input type="radio" name="q2_9_1" <?php if (isset($_POST['q2_9_1']) && $_POST['q2_9_1'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_9_1" <?php if (isset($_POST['q2_9_1']) && $_POST['q2_9_1'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                       <div> 
						      <label for="q2_9_2"><p class="question">2.9.b: Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?</p></label>
						      <div class="input"><input type="radio" name="q2_9_2" <?php if (isset($_POST['q2_9_2']) && $_POST['q2_9_2'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_9_2" <?php if (isset($_POST['q2_9_2']) && $_POST['q2_9_2'] == 0) echo "checked";?> value=0>No</div>
                        </div>
                        <div>
						      <label for="q2_9_3"><p class="question">2.9.c: Do you currently live with two chronic conditions?</p></label>
						      <div class="input"><input type="radio" name="q2_9_3" <?php if (isset($_POST['q2_9_3']) && $_POST['q2_9_3'] == 1) echo "checked";?> value=1>Yes</div>
						      <div class="input"><input type="radio" name="q2_9_3" <?php if (isset($_POST['q2_9_3']) && $_POST['q2_9_3'] == 0) echo "checked";?> value=0>No</div>
                        </div>
					</div>
				</div> <!-- end div for question 2.9 -->
			</fieldset>
		</div> <!-- end section2 -->
		<br><br>
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
				name = "q2_" + i;
				radio = document.getElementsByName(name);
				if ($(radio).is(":checked")) {
					$(radio).prop("checked", false);
					loopSubQuestions(radio, name);
				}
			}
		}
	}

	// switch the required attribute between true and false depending on input
	function switchRequiredAttribute(name, howmany, value)	{
		for (var i = 1; i <= howmany; i++) {
			if (value === "false")
				$("[name="+name+"_"+i+"]").attr("required", false);
			else
				$("[name="+name+"_"+i+"]").attr("required", true);								
		}
			
	}

	/* Generic function for all section 2 questions, if yes show sub-questions, if no hide */
	function s2RadiosClick(radioElement, divID) {
		var count = $("#"+divID+" > div").length;
		if ($(radioElement).val() == 1) {
			$("#"+ divID).show("slow");			
			switchRequiredAttribute(divID, count, "true");
		}
		else {
			$("#"+ divID).hide("slow");
			loopSubQuestions(radioElement, divID);
		}
	}

	function loopSubQuestions(radioElement, divID) {
		var count = $("#"+divID+" > div").length;
		$("#"+ divID).hide("slow");			
		switchRequiredAttribute(divID, count, "false");
		uncheckSubQuestions(divID, count);
	}

	function uncheckSubQuestions(name, count) {
		for (var i = 1; i <= count; i++) {
			$("[name="+name+"_"+i+"]").prop("checked", false);
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
