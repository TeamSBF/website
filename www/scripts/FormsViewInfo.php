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

$questionnaire_questions = array("How often do you perform the Sit and Be Fit exercises?:" => array("Less than once a month", "Once per month", "Once per week", "More than once per week"),
			"How long have you participated in the Sit and Be Fit program?:" => array("Less than 3 months", "3 to 6 months", "6 to 12 months", "More than 12 months"),
          	"You exercise:" => array("By yourself", "With a partner", "With a class", "Other"), 
          	"Where do you exercise:" => array("Home", "Gym", "Other"),
          	"Do you consider the Sit and Be Fit program host Mary Ann Wilson to be your exercise partner?:" => array("No", "Yes"),
          	"How would you have rated your overall health BEFORE starting the Sit and Be Fit program?:" => array("Excellent", "Very good", "Good", "Fair", "Poor"),
            "How would you rate your current overall health?:" => array("Excellent", "Very good", "Good", "Fair", "Poor"), 
            "Do you use an aid for walking? If so please select the aid usually used:" => array("None", "Wheel Chair", "Walker", "Cane"),
            "How many times have you fallen in the last year?:" => array("None", "1 time", "2 times", "3 or more"), 
            "Do you have pains?:" => array("No", "Yes"), 
            "Do you have trouble sleeping at night?:" => array("No", "Yes"),
            "Hearing/Vision problems?" => array("No", "Yes"),
            "Heart/Vascular problems?" => array("No", "Yes"), 
            "Lung problems?" => array("No", "Yes"), 
            "Nervous system problems?" => array("No", "Yes"),
            "Hormone/Endoctrine problems?" => array("No", "Yes"), 
            "Kidney/Bladder problems?" => array("No", "Yes"), 
            "Cancer problems?" => array("No", "Yes"), 
            "Digestive problems?" => array("No", "Yes"),
            "Muscle joints or bone problems?" => array("No", "Yes"), 
            "Skin problems?" => array("No", "Yes"),
            "Other medical conditions:",
            "Age:",
            "Gender:" => array("Female", "Male"),
            "Ethnicity:" => array("Asian", "African American", "Caucasian", "Hispanic", "Native American"),
            "Highest level of Education:",
            "Current working status:",
            "Number of members in your household:",
            "Annual Income:",
            "Current Height (in inches):",
            "Current Weight (in pounds):",
            "Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1",           
            "Lifting or carrying groceries:" => array("No help", "Some help", "Unable to perform"),
            "Climbing one flight of stairs:" => array("No help", "Some help", "Unable to perform"),
            "Stepping up and down a small curb:" => array("No help", "Some help", "Unable to perform"), 
            "Picking up small object from the floor:" => array("No help", "Some help", "Unable to perform"),
          	"Walking a mile or more:" => array("No help", "Some help", "Unable to perform"),
          	"Walking 2-3 blocks:" => array("No help", "Some help", "Unable to perform"),
          	"Walking around in your home:" => array("No help", "Some help", "Unable to perform"),
          	"Bathing or dressing yourself:" => array("No help", "Some help", "Unable to perform"),
          	"Getting in and out of a car:" => array("No help", "Some help", "Unable to perform"),
          	"Writing on a computer Keyboard:" => array("No help", "Some help", "Unable to perform"),
          	"Preparing meals:" => array("No help", "Some help", "Unable to perform"), 
          	"Cleaning your home:" => array("No help", "Some help", "Unable to perform"),
          	"Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:",
          	"Feel full of life?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel nervous?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel that you are playing a useful part in things?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel calm and peaceful?:" => array("Always", "Mostly", "Half the time", "Rarely"), "Have a lot of energy?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel depressed?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel worn out?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel happy?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel satisfied with your life?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel full of life?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel nervous?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel that you are playing a useful part in things?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel calm and peaceful?:" => array("Always", "Mostly", "Half the time", "Rarely"), "Have a lot of energy?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel depressed?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel worn out?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel happy?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"Feel satisfied with your life?:" => array("Always", "Mostly", "Half the time", "Rarely"),
          	"How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:"
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