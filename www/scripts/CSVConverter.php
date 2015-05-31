<?php

class CSVConverter {
	
    public function GetCSV($type, $start, $end)
    {
        // note the php://output, that's required
        $out;

        // = fopen('php://output', 'w');
        switch($type)
        {
            case "assessments":
            	$out = $this->getAssessmentCSV(); 
        		break;
            case "parq":
            	$out = $this->getParQCSV();
            	break;
            case "questionnaire":
            	$out = $this->getQuestionnaireCSV();
            	break;
            case "enrollment":
            	$out = $this->getEnrollmentCSV($start, $end);
            	break;
        }
        // include the headers that tell the browser it's receiving a download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename='.$type.'_data.csv');
        // close the file (which is actually a variable)
        fclose($out);
    }
	/*
	Query the parq_form table and selects everything.
	Convert all relevant numerical values to english and prints to a csv file.
	*/
	public function getParQCSV()
	{
		$query = QueryFactory::Build('select');
		$query->Select("userID","q1_1","q1_2","q1_3","q1_4","q1_5","q1_6","q1_7","q2_1","q2_1_1","q2_1_2","q2_1_3",
			"q2_2","q2_2_1","q2_2_2","q2_3","q2_3_1","q2_3_2","q2_3_3","q2_3_4","q2_3_5","q2_4","q2_4_1","q2_4_2",
			"q2_4_3","q2_5","q2_5_1","q2_5_2","q2_6","q2_6_1","q2_6_2","q2_6_3","q2_6_4","q2_7","q2_7_1","q2_7_2",
			"q2_7_3","q2_8","q2_8_1","q2_8_2","q2_8_3","q2_9","q2_9_1","q2_9_2","q2_9_3","q3_1","q3_2","q3_3")->From("parq_form")->Where(["completed","=","1"]);

		$qinfo = DatabaseManager::Query($query);

		$file = fopen("php://output", "w") or die("Unable to open parq_data file");
		
		if ($qinfo->RowCount() < 2)
		{
			fwrite($file, "Not enough data to create a CSV file\n");
			return $file;
		}

		$parq_header = array("User ID "," 1.1 "," 1.2 "," 1.3 "," 1.4 "," 1.5 "," 1.6 "," 1.7 "," 2.1 "," 2.1a "," 2.1b "," 2.1c "," 2.2 "," 2.2a "," 2.2b "," 2.3 "," 2.3a "," 2.3b "," 2.3c "," 2.3d "," 2.3e ",
			" 2.4 "," 2.4a "," 2.4b "," 2.4c "," 2.5 "," 2.5a "," 2.5b "," 2.6 "," 2.6a "," 2.6b "," 2.6c "," 2.6d "," 2.7 "," 2.7a "," 2.7b "," 2.7c "," 2.8 "," 2.8a "," 2.8b "," 2.8c "," 2.9 "," 2.9a "," 2.9b "," 2.9c ",
			"Date Completed","Signature","Parent/care provider signature");

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

		return $file;
	}

	/*
	Query the enrollment_form table and selects everything.
	Convert all relevant numerical values to english and prints to a csv file.
	*/
	public function getEnrollmentCSV($start, $end)
	{
		$query = QueryFactory::Build('select');

		$query->Select("userID", "DateCompleted" ,"lastName","firstName","streetAddress","city","phone","email","dob","gender","healthHistory",
			"watchSbf","HowManyTimesAWeek","controlGroup","experimentalGroup")->From("enrollment_form")->Where(["completed","=","1", "AND"],
			["DateCompleted", ">", $start, "AND"], ["DateCompleted", "<", $end]);

		$qinfo = DatabaseManager::Query($query);

		$file = fopen("php://output", "w") or die("Unable to open enrollment_data file");
		
		if ($qinfo->RowCount() < 2)
		{
			fwrite($file, "Not enough data to create a CSV file\n");
			return $file;
		}

		$array = $qinfo->Result();

		

		$header = array("User ID", "Date Completed" ,"Last Name", "First Name", "Street Address", "City", "Phone", "Email", "Date of Birth", "Gender",
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

		return $file;
	}

	/*
	Query the questionnaire_form table and selects everything.
	Convert all relevant numerical values to english and prints to a csv file.
	*/
	public function getQuestionnaireCSV()
	{
		$query = QueryFactory::Build('select');

		$query->Select("userID","q1","q2","q3","q4","q5","q6","q7","q8","q9","q10","q11","q12","q13","q14","q15","q16","q17","q18","q19","q20",
			"q21","q22","q23","q24","q25","q26","q27","q28","q29","q30","q31","q32","q33","q34","q35","q36","q37","q38","q39","q40","q41","q42",
			"q43","q44","q45","q46","q47","q48","q49","q50","q51","q52","q53","q54","q55","q56","q57","q58","q59","q60","q61","q62","q63","q64")->From("questionnaire_form")->Where(["completed","=","1"]);

		$qinfo = DatabaseManager::Query($query);

		$file = fopen("php://output", "w") or die("Unable to open questionnaire_data file");

		if ($qinfo->RowCount() < 2)
		{
			fwrite($file, "Not enough data to create a CSV file\n");
			return $file;
		}

		$array = $qinfo->Result();		
				
		// print header values to CSV file
		fwrite($file, "User ID,");
		$numQuestion = 64;
		for($i = 1; $i < $numQuestion; $i++)
		{
			fwrite($file, $i . ",");
		}
		fwrite($file, "64\n");
		
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

        $gender = array("Female", "Male");

        $race = array("Asian", "African American", "Caucasian", "Hispanic", "Native American");

        $work = array("Employed", "Unemployed", "Retired");

        $help = array("No help", "Some help", "Unable to perform");

        $time = array("Always", "Mostly", "Half the time", "Rarely");

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
        			$array[$key]["q$i"] = $how[$i-1][$array[$key]["q$i"]];
        		}
        		else if ($i < 22)
        		{
        			$array[$key]["q$i"] = $yesno[$array[$key]["q$i"]];
        		}
        		else if ($i == 24)
        		{
        			$array[$key]["q$i"] = $gender[$array[$key]["q$i"]];
        		}
        		else if ($i == 25)
        		{
        			$array[$key]["q$i"] = $race[$array[$key]["q$i"]];
        		}
        		else if ($i == 27)
        		{
        			$array[$key]["q$i"] = $work[$array[$key]["q$i"]];
        		}
        		else if ($i > 32 && $i < 45)
        		{
        			$array[$key]["q$i"] = $help[$array[$key]["q$i"]];
        		}
        		else if ($i > 45 && $i < 64)
        		{
        			$array[$key]["q$i"] = $time[$array[$key]["q$i"]];
        		}
        	}
        }          

		$this->printCSV($file, $array);

		return $file;
	}

	/*
	Query the assessemnt table and selects everything.
	Convert all relevant numerical values to english and prints to a csv file
	*/
	public function getAssessmentCSV()
	{
		//TO-DO
	}

	/*
	Queries each relevant data table and save the number of rows returned
	by the query in an array
	return: $value_array
	*/
	public function getDataTableRowCount()
	{
		$query = QueryFactory::Build('select');
		$query->Select('id')->From('enrollment_form');
		$enrolCount = DatabaseManager::Query($query);

		$query = QueryFactory::Build('select');
		$query->Select('id')->From('questionnaire_form');
		$questCount = DatabaseManager::Query($query);

		$query = QueryFactory::Build('select');
		$query->Select('id')->From('parq_form');
		$parqCount = DatabaseManager::Query($query);

		/*
		uncomment when assessments are working and done
		$query = QueryFactory::Build('select');
		$query->Select('id')->From('assessment');
		$enrolCount = DatabaseManager::Query($query);
		*/

		// add the value for assessments when they are done
		$value_array = array($enrolCount->RowCount(), $questCount->RowCount(), $parqCount->RowCount());

		return $value_array;
	}

	/*
	Given an array of values, prints each value in CSV format to a file
	$params: $file (file pointer), $array (the array of values)
	*/
	private function printCSV($file, $array)
	{
		//print each arrays of values as line in csv format
		foreach($array as $row)
		{
			fputcsv($file, $row);
		}
	}
}
