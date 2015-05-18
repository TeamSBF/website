<?php
require_once"header.php";

$f = new CSVConverter();
$q = $f->getParQCSV();

print_r($q);



class CSVConverter {
	
	/* Returns a CSV file */
	public function getParQCSV()
	{
		$query = QueryFactory::Build('select');
		$query->Select("userID","q1_1","q1_2","q1_3","q1_4","q1_5","q1_6","q1_7","q2_1","q2_1_1","q2_1_2","q2_1_3",
			"q2_2","q2_2_1","q2_2_2","q2_3","q2_3_1","q2_3_2","q2_3_3","q2_3_4","q2_3_5","q2_4","q2_4_1","q2_4_2",
			"q2_4_3","q2_5","q2_5_1","q2_5_2","q2_6","q2_6_1","q2_6_2","q2_6_3","q2_6_4","q2_7","q2_7_1","q2_7_2",
			"q2_7_3","q2_8","q2_8_1","q2_8_2","q2_8_3","q2_9","q2_9_1","q2_9_2","q2_9_3","q3_1","q3_2","q3_3")->From("parq_form")->Where(["completed","=","1"]);

		$qinfo = DatabaseManager::Query($query);

		if ($qinfo->RowCount() < 2)
		{
			return "Not enough data to create a CSV file";
		}

		$parq_header = array("User ID "," 1.1 "," 1.2 "," 1.3 "," 1.4 "," 1.5 "," 1.6 "," 1.7 "," 2.1 "," 2.1a "," 2.1b "," 2.1c "," 2.2 "," 2.2a "," 2.2b "," 2.3 "," 2.3a "," 2.3b "," 2.3c "," 2.3d "," 2.3e ",
			" 2.4 "," 2.4a "," 2.4b "," 2.4c "," 2.5 "," 2.5a "," 2.5b "," 2.6 "," 2.6a "," 2.6b "," 2.6c "," 2.6d "," 2.7 "," 2.7a "," 2.7b "," 2.7c "," 2.8 "," 2.8a "," 2.8b "," 2.8c "," 2.9 "," 2.9a "," 2.9b "," 2.9c ",
			"Date Completed","Signature","Parent/care provider signature");

		$file = fopen("parq_data.csv", "w") or die("Unable to open parq_data file");

		// print header values to CSV file
		foreach($parq_header as $val)
		{
			if ($val === "Parent/care provider signature")
				fwrite($file, $val . "\n");
			else
				fwrite($file, $val . ",");
		}

		$array = $qinfo->Result();

		// replace numeric value to english values
		foreach($array as $key => $val)
		{
			foreach($val as $k => $v)
			{
				if ($k === "userID")
					continue;
				else if ($v === "-1" || $v === "")
					$array[$key][$k] = "n/a";
				else if ($v === "0")
					$array[$key][$k] = "NO";
				else if ($v === "1")
					$array[$key][$k] = "YES";
			}
		}

		$this->printCSV($file, $array);

		fclose($file);

		return $array;
	}

	public function getEnrollmentCSV()
	{
		$query = QueryFactory::Build('select');

		$query->Select("userID","lastName","firstName","streetAddress","city","phone","email","dob","gender","healthHistory",
			"watchSbf","HowManyTimesAWeek","controlGroup","experimentalGroup")->From("enrollment_form")->Where(["completed","=","1"]);

		$qinfo = DatabaseManager::Query($query);

		if ($qinfo->RowCount() < 2)
		{
			return "Not enough data to create a CSV file";
		}

		$array = $qinfo->Result();

		$file = fopen("enrollment_data.csv", "w") or die("Unable to open enrollment_data file");

		$header = array("User ID", "Last Name", "First Name", "Street Address", "City", "Phone", "Email", "Date of Birth", "Gender",
			"Health History", "Watch SBF", "How Many Times a Week", "Control Group", "Experimental Group");
				
		// print header values to CSV file
		foreach($header as $val)
		{
			if ($val === "Experimental Group")
				fwrite($file, $val . "\n");
			else
				fwrite($file, $val . ",");
		}
		
		// replace numeric value to english values
		foreach($array as $key => $val)
		{
			foreach($val as $k => $v)
			{
				if ($k === "userID")
					continue;
				else if ($k === "gender")
				{
					if ($v === "0")
						$array[$key][$k] = "Female";
					else if ($v === "1")
						$array[$key][$k] = "Male";
				}				
				else if ($v === "0" && $k != "HowManyTimesAWeek")
					$array[$key][$k] = "NO";
				else if ($v === "1" && $k != "HowManyTimesAWeek")
					$array[$key][$k] = "YES";
			}
		}

		$this->printCSV($file, $array);

		fclose($file);

		return $array;
	}

	public function getQuestionnaireCSV()
	{
		$query = QueryFactory::Build('select');

		$query->Select("userID","q1","q2","q3","q4","q5","q6","q7","q8","q9","q10","q11","q12","q13","q14","q15","q16","q17","q18","q19","q20",
			"q21","q22","q23","q24","q25","q26","q27","q28","q29","q30","q31","q32","q33","q34","q35","q36","q37","q38","q39","q40","q41","q42",
			"q43","q44","q45","q46","q47","q48","q49","q50","q51","q52","q53","q54","q55","q56","q57","q58","q59","q60","q61","q62","q63","q64")->From("questionnaire_form")->Where(["completed","=","1"]);

		$qinfo = DatabaseManager::Query($query);

		if ($qinfo->RowCount() < 2)
		{
			return "Not enough data to create a CSV file";
		}

		$array = $qinfo->Result();

		$file = fopen("questionnaire_data.csv", "w") or die("Unable to open questionnaire_data file");
				
		// print header values to CSV file
		fwrite($file, "User ID,");
		$numQuestion = 64;
		for($i = 0; $i < $numQuestion; $i++)
		{
			fwrite($file, $i . ",");
		}
		fwrite($file, "64");
		
		// TO-DO: replace numeric value to english values
		// define arrays of values for various radio buttons that will be used to convert from numerical values to english
		$how = array( array("Less than once a month", "Once per month", "Once per week", "More than once per week"),
          array("Less than 3 months", "3 to 6 months", "6 to 12 months", "More than 12 months"),
          array("By yourself", "With a partner", "With a class", "Other"),
          array("Home", "Gym", "Other"),
          array("No", "Yes"),
          array("Excellent", "Very good", "Good", "Fair", "Poor"),
          array("Excellent", "Very good", "Good", "Fair", "Poor"),
          array("None", "Wheel Chair", "Walker", "Cane"),
          array("None", "1 time", "2 times", "3 or more"));
          
        $yesno = array("No", "Yes");

        $help = array("No help", "Some help", "Unable to perform");

        $time = array("Always", "Mostly", "Half the time", "Rarely");

        print_r($array);

        // QUESTIONS 1-9 included use $how

        // QUESTIONS 10-21 included use $yesno

        // QUESTION 24 is custom (Male, Female)

        // QUESTION 25 is custom (Asian, African American, Caucasian, Hispanic, Native American)

        // QUESTION 27 is custom (Employed, Unemployed, Retired)

        // QUESTIONS 33-44 included use $help

        // QUESTIONS 46-63 included use $time
        foreach($array as $key => $val)
        {
        	for ($i = 1; $i <= $numQuestion; $i++)
        	{
        		if ($i < 10)
        		{
        			$array[$key]["q$i"] = $how[$i][$array[$key]["q$i"]];
        		}
        		else if ($i < 23)
        		{

        		}
        		else if ($i == 25)
        		{

        		}
        		else if ($i == 26)
        		{

        		}
        		else if ($i == 28)
        		{

        		}
        		else if ($i > 33 && $i < 46)
        		{

        		}
        		else if ($i > 46 && $i < 65)
        		{

        		}
        	}
        }          

		//$this->printCSV($file, $array);

		//fclose($file);

		//return $array;
	}

	public function getAssessmentCSV()
	{

	}

	private function printCSV($file, $array)
	{
		//print each arrays of values as line in csv format
		foreach($array as $row)
		{
			fputcsv($file, $row);
		}
	}

	private function convertQuestionnaireValue($arr, $val)
	{

	}

	// this array is not even used, just keep it for now in case we decide to swap the parQ header values, don;t want to have to type this again
	private $parq_headers = array("Has your doctor ever said that you have a heart condition OR high blood pressure?",
			"Do you feel pain in your chest at rest, during your daily activities of living, OR when you do physical activity?",
			"Do you lose balance because of dizziness OR have you lost consciousness in the last 12 months?",
			"Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?",
			"Are you currently taking prescribed medications for a chronic medical condition?",
			"Do you have a bone or joint problem that could be made worse by becoming more physically active?",
			"Has your doctor ever said that you should only do medically supervised physical activity?",
			"Do you have Arthritis, Osteoporosis, or Back Problems?","Do you have difficulty controlling your condition with medications or other physician_prescribed therapies?",
			"Do you have joint problems causing pain, a recent fracture or fracture caused by osteoporosis or cancer, displaced vertebra, and/or spondylolysis/pars defect?",
			"Have you had steroid injections or taken steroid tablets regularly for more than 3 months?",
			"Do you have Cancer of any kind?", "Does your cancer diagnosis include any of the following types: lung/bronchogenic, multiple myeloma (cancer of plasma cells), head, and neck?",
			"Are you currently receiving cancer therapy?","Do you have Heart Disease or Cardiovascular Disease?",
			"Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?",
			"Do you have an irregular heart beat that requires medical management?","Do you have chronic heart failure?",
			"Do you have a resting blood pressure equal to or greater than 160/90 mmHg with or without medication?",
			"Do you have diagnosed coronary artery (cardiovascular) disease and have not participated in regular physical activity in the last 2 months?",
			"Do you have any Metabolic Conditions?","Is your blood sugar often above 13.0 mmol/L?",
			"Do you have any signs or symptoms of diabetes complications such as heart or vascular disease and/or complications affecting your eyes, kidneys, and the sensation in your toes and feet?",
			"Do you have other metabolic conditions?","Do you have any Mental Health Problems or Learning Difficulties?",
			"Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?",
			"Do you also have back problems affecting nerves or muscles?","Do you have a Respiratory Disease?",
			"Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?",
			"Has your doctor ever said your blood oxygen level is low at rest or during exercise and/or that you require supplemental oxygen therapy?",
			"If asthmatic, do you currently have symptoms of chest tightness, wheezing, laboured breathing, consistent cough (more than 2 days/week), or have you used your rescue medication more than twice in the last week?",
			"Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?",
			"Do you have a Spinal Cord Injury?","Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?",
			"Do you commonly exhibit low resting blood pressure significant enough to cause dizziness, light_headedness, and/or fainting?",
			"Has your physician indicated that you exhibit sudden bouts of high blood pressure (known as Autonomic Dysreflexia)?",
			"Have you had a Stroke?","Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?",
			"Do you have any impairment in walking or mobility?","Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?",
			"Do you have any other medical condition not listed above or do you live with two chronic conditions?",
			"Have you experienced a blackout, fainted, or lost consciousness as a result of a head injury within the last 12 months OR have you had a diagnosed concussion within the last 12 months?",
			"Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?",
			"Do you currently live with two chronic conditions?",
			"Date Completed","Signature","Parent/Guardian/Care Provider Signature");
}
require_once"footer.php";