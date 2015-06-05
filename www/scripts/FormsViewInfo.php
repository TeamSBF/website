<?php
/* This file contains array of questions and optional values 
 * In case the forms need to be refactored or for any use really
 * Contains all questions and posssible values array (for radio button option) */
$parq_values = array("No", "Yes");
$parq_questions = array(
            "GENERAL HEALTH" => [ // section 1
            new Question("Has your doctor ever said that you have a heart condition OR high blood pressure?"),
			new Question("Do you feel pain in your chest at rest, during your daily activities of living, OR when you do physical activity?"),
			new Question("Do you lose balance because of dizziness OR have you lost consciousness in the last 12 months?"),
			new Question("Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?"),
			new Question("Are you currently taking prescribed medications for a chronic medical condition?"),
			new Question("Do you have a bone or joint problem that could be made worse by becoming more physically active?"),
			new Question("Has your doctor ever said that you should only do medically supervised physical activity?"),
			],
            "CHRONIC MEDICAL CONDITIONS" => [ // section 2
            new Question("Do you have Arthritis, Osteoporosis, or Back Problems?", [
                new Question("Do you have difficulty controlling your condition with medications or other physician_prescribed therapies?(Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Do you have joint problems causing pain, a recent fracture or fracture caused by osteoporosis or cancer, displaced vertebra (e.g., spondylolisthesis), and/or spondylolysis/pars defect (a crack in the bony ring on the back of the spinal column)?"),
                new Question("Have you had steroid injections or taken steroid tablets regularly for more than 3 months?")
                ]),
            
            new Question("Do you have Cancer of any kind?", [
                new Question("Does your cancer diagnosis include any of the following types: lung/bronchogenic, multiple myeloma (cancer of plasma cells), head, and neck?"),
                new Question("Are you currently receiving cancer therapy (such as chemotherapy or radiotherapy)?")
                ]),
            
            new Question("Do you have Heart Disease or Cardiovascular Disease? This includes Coronary Artery Disease, High Blood Pressure, Heart Failure, Diagnosed Abnormality of Heart Rhythm",[
                new Question("Do you have difficulty controlling your condition with medications or other physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Do you have an irregular heart beat that requires medical management? (e.g. atrial fibrillation, premature ventricular contraction"),
                new Question("Do you have chronic heart failure?"),
                new Question("Do you have a resting blood pressure equal to or greater than 160/90 mmHg with or without medication? (Answer YES if you do not know your resting blood pressure)"),
                new Question("Do you have diagnosed coronary artery (cardiovascular) disease and have not participated in regular physical activity in the last 2 months?")
                ]),
            
            new Question("Do you have any Metabolic Conditions? This includes Type 1 Diabetes, Type 2 Diabetes, Pre-Diabetes", [
                new Question("Is your blood sugar often above 13.0 mmol/L? (Answer YES if you are not sure)"),
                new Question("Do you have any signs or symptoms of diabetes complications such as heart or vascular disease and/or complications affecting your eyes, kidneys, and the sensation in your toes and feet?"),
                new Question("Do you have other metabolic conditions (such as thyroid disorders, pregnancyrelated diabetes, chronic kidney disease, liver problems)?")
                ]),
      
            new Question("Do you have any Mental Health Problems or Learning Difficulties? This includes Alzheimer’s, Dementia, Depression, Anxiety Disorder, Eating Disorder, Psychotic Disorder, Intellectual Disability, Down Syndrome)", [
                new Question("Do you have difficulty controlling your condition with medications or other physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Do you also have back problems affecting nerves or muscles?")
                ]),
            
            new Question("Do you have a Respiratory Disease? This includes Chronic Obstructive Pulmonary Disease, Asthma, Pulmonary High Blood Pressure", [
                new Question("Do you have difficulty controlling your condition with medications or other physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Has your doctor ever said your blood oxygen level is low at rest or during exercise and/or that you require supplemental oxygen therapy?"),
                new Question("If asthmatic, do you currently have symptoms of chest tightness, wheezing, laboured breathing, consistent cough (more than 2 days/week), or have you used your rescue medication more than twice in the last week?"),
                new Question("Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?")
                ]),
      
            new Question("Do you have a Spinal Cord Injury? This includes Tetraplegia and Paraplegia", [
                new Question("Do you have difficulty controlling your condition with medications or other physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Do you commonly exhibit low resting blood pressure significant enough to cause dizziness, light_headedness, and/or fainting?"),
                new Question("Has your physician indicated that you exhibit sudden bouts of high blood pressure (known as Autonomic Dysreflexia)?")
                ]),
      
            new Question("Have you had a Stroke? This includes Transient Ischemic Attack (TIA) or Cerebrovascular Event", [
                new Question("Do you have difficulty controlling your condition with medications or other physician-prescribed therapies? (Answer NO if you are not currently taking medications or other treatments)"),
                new Question("Do you have any impairment in walking or mobility?"),
                new Question("Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?")
                ]),
            
            new Question("Do you have any other medical condition not listed above or do you live with two chronic conditions?", [
                new Question("Have you experienced a blackout, fainted, or lost consciousness as a result of a head injury within the last 12 months OR have you had a diagnosed concussion within the last 12 months?"),
                new Question("Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?"),
                new Question("Do you currently live with two chronic conditions?")
                ])
            ]);
      //"Date Completed",
      //"Signature (type your full name)",
      //"Parent/Guardian/Care Provider Signature (If applicable)"

$questionnaire_questions = array(
            ""=>[
                    new Question("How often do you perform the Sit and Be Fit exercises?:", null, ["Less than once a month", "Once per month", "Once per week", "More than once per week"]),
                    new Question("How long have you participated in the Sit and Be Fit program?:", null, ["Less than 3 months", "3 to 6 months", "6 to 12 months", "More than 12 months"]),
                    new Question("You exercise:",null, ["By yourself", "With a partner", "With a class", "Other"]),
                    new Question("Where do you exercise:", null, ["Home", "Gym", "Other"]),
                    new Question("Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:")
                ],
            "Health Questions" =>[
                    new Question("How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:", null,["Excellent", "Very good", "Good", "Fair", "Poor"]),
                    new Question("How would you rate your current overall health?:", null, ["Excellent", "Very good", "Good", "Fair", "Poor"]),
                    new Question("Do you use an aid for walking? If so please select the aid usually used:", null, ["None", "Wheel Chair", "Walker", "Cane"]),
                    new Question("How many times have you fallen in the last year?:", null, ["None", "1 time", "2 times", "3 or more"]),
                    new Question("Do you have pains?:"),
                    new Question("Do you have trouble sleeping at night?:")
                ],
            "Health Problems" =>[
                    new Question("Hearing/Vision problems?"),
                    new Question("Heart/Vascular problems?"),
                    new Question("Lung problems?"),
                    new Question("Nervous system problems?"),
                    new Question("Hormone/Endoctrine problems?"),
                    new Question("Kidney/Bladder problems?"),
                    new Question("Cancer problems?"),
                    new Question("Digestive problems?"),
                    new Question("Muscle joints or bone problems?"),
                    new Question("Skin problems?"),
                    new Question("Other medical conditions:",null, [["textarea",['name'=>'q22','rows'=>'3','cols'=>'15','style'=>'width:auto;']]])
                ],
            "Demographics"=>[
                    new Question("Age:", null, [['number',['name'=>'q23', 'placeholder'=>'Your Age']]]),
                    new Question("Gender:", null, ["Female", "Male"]),
                    new Question("Ethnicity:", null, ["Asian", "African American", "Caucasian", "Hispanic", "Native American"]),
                    new Question("Highest level of Education:", null, [['text',['name'=>'q26']]]),
                    new Question("Current working status:", null, ['Employed','Unemployed','Retired']),
                    new Question("Number of members in your household:", null, [['number',['name'=>'q28','placeholder'=>'Household Number']]]),
                    new Question("Annual Income:", null, [['number',['name'=>'q29', 'placeholder'=>'Income Per Year']]]),
                    new Question("Current Height (in inches):", null, [['number', ['name'=>'q30','placeholder'=>'Your Height']]]),
                    new Question("Current Weight (in pounds):", null, [['number', ['name'=>'q31','placeholder'=>'Your Weight']]]),
                    new Question("Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1", null, [['textarea',['name'=>'q32']]])
                ],
            "Please rate your ability to perform certain activities that might occur during a typical day" => [
                    new Question("Lifting or carrying groceries:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Climbing one flight of stairs:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Stepping up and down a small curb:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Picking up small object from the floor:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Walking a mile or more:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Walking 2-3 blocks:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Walking around in your home:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Bathing or dressing yourself:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Getting in and out of a car:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Writing on a computer Keyboard:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Preparing meals:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Cleaning your home:", null, array("No help", "Some help", "Unable to perform")),
                    new Question("Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:", null, [['textarea',['name'=>'q45']]])
                ],
            "The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program." => [
                    new Question("Feel full of life?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel nervous?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel that you are playing a useful part in things?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel calm and peaceful?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Have a lot of energy?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel depressed?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel worn out?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel happy?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel satisfied with your life?:", null, array("Always", "Mostly", "Half the time", "Rarely"))
                ],
            "The following questions are about how you feel currently" => [
                    new Question("Feel full of life?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel nervous?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel that you are playing a useful part in things?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel calm and peaceful?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Have a lot of energy?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel depressed?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel worn out?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel happy?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("Feel satisfied with your life?:", null, array("Always", "Mostly", "Half the time", "Rarely")),
                    new Question("How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:", null, [['textarea',['name'=>'q64']]])
                ]
          	);

$enrollment_questions = array(
			"Last Name",
			"First Name",
			"Street Address",
			"City",
			"Phone",
			"E-mail",
			"Date of Birth",
			"Gener" => array("Female", "Male"),
			"Health History",
			"Do you watch Sit and Be Fit?" => array("No", "Yes"),
			"How many times a week?",
			"Control Group (will NOT participate in Sit and Be Fit)" => array("No", "Yes"),
			"Experimental Group (participate in Sit and Be Fit)" => array("No", "Yes")
			);