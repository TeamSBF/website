<?php

/*
*	FormsModel.php: Validates form data, build insert queries, and save to the database.
*	One entry point (function) per Form.*
*
*/

class FormsModel
{
	private $form;
	/* Constructor
	 * @param: $data is an associative array sent by the form	
	 */
	public function __construct($data)
	{
		$this->form = $data;
	}

	/* Entry point for the enrollment form */
	public function validateEnrollment()
	{
		// do some checks here
		if($empties = $this->CheckforEmpties() != "")
			return $empties;


		// if everything went well we save data to the database
		 return $this->saveDbEnrollment();

	}

	/* Entry point for the pre-study questionnaire part 1 form */
	public function validateQuestionnaireP1()
	{
		// do some checks here

		// if everything went well we save data to the database
		if ($this->saveDbQuestionnaireP1())
			return '***Success!***';
		return "***DB SAVE FAILED***";
	}

	/* Entry point for the pre-study questionnaire part 2 form */
	public function validateQuestionnaireP2()
	{
		// do some checks here

		// if everything went well we save data to the database
		if ($this->saveDbQuestionnaireP2())
			return '***Success!***';
		return "***DB SAVE FAILED***";
	}

	/* Entry point for the parQ form */
	public function validateParQ()
	{
		return $this->validateAndSaveParQ();
	}

	/* check if a field is empty */
	private function checkforEmpties()
	{
		for ($i = 0; $i < $this->form->length; $i++)
		{
			if ($this->form[i] == "")
				return 'Some required fields are missing, every field preceded by a * are required';
		}
		return "";
	}

	/* Checks if some input contains character we don't want */
	private function checkForIllegalCharacters($str)
	{
		return !preg_match('/[^A-Za-z0-9.!?\\-$\']/', $str);

	}

	/* Checks if a given string is below allowed length
	 * $param: $value (string), $length (int) 
	 */
	private function validateValueLength($value, $length)
	{
		if (strlen($value) > $length)
			return false;
		return true;
	}

	/* Validate an email address using php built-in validation 
	 * $param: $email (string)
	 */
	private function validateEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		return false;
	}

	/* Validates a date using php built-in validation
	 * $param: $date (string), $format (default is Y-m-d)
	 */
	private function validateDate($date, $format = 'Y-m-d')
	{
    	$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

	/* Validates a radio button
	 * $param: 	$value (string)
	 *			$options (array of possible accepted values)
	 */
	private function validateRadioButton($value=null, $options=null)
	{
		foreach ($options as $val)
		{
			if ($value === $val)
				return true;
		}
		return false;
	}

	/* Validates a phone number
	 * $param: $phone (string)
	 */
	private function ValidatePhone($phone)
	{
		//TO DO
	}

	/* Validates the enrollment form data, build the insert query and save to the database */
	private function saveDbEnrollment()
	{
		$form = $this->form;
		// get a Insert query object
		$insert = QueryFactory::Build('insert');
		// build the query
        $insert->Into('enrollment_form')->Set(['lastName', $form['lName']], ['firstName', $form['fName']], ['streetAddress', $form['streetAddress']],
        	['city', $form['city']], ['phone', $form['phone']], ['email', $form['email']], ['dob', $form['dob']], ['gender', $form['gender']],
        	['healthHistory', $form['healthHistory']], ['watchSbf', $form['watchSbf']], ['howManyTimesAWeek', $form['howMany']],
        	['controlGroup', $form['controlGrp']], ['experimentalGroup', $form['experimentalGrp']]);
        
        // save to the DB
        $qinfo = DatabaseManager::Query($insert);
        // check for success or failure
        if ($qinfo->RowCount() == 1)
            return true;

        return false;
	}

	/* Validates the questionnaire part 2 form data, build the insert query and save to the database */
	private function saveDbQuestionnaireP1()
	{
		//TO DO
	}

	/* Validates the questionnaire part 2 form data, build the insert query and save to the database */
	private function saveDbQuestionnaireP2()
	{
		//TO DO
	}

	/* Validates the parQ form data, build the insert query and save to the database */
	private function validateAndSaveParQ()
	{		
		// get a Insert query object
		$insert = QueryFactory::Build('insert');
		$insert->Into("parq_form");

		//return $this->validateParQFieldsAndBuildQuery($insert);
		$insert = $this->validateParQFieldsAndBuildQuery($insert);
		// Check if validation passed
		if ($insert == false)
			return false;
		//return printr($insert->Query(true));
        // save to the DB
        $qinfo = DatabaseManager::Query($insert);

        // check for success or failure
        if ($qinfo->RowCount() == 1)
        {
        	$complete = QueryFactory::Build('insert');
        	$complete->Into('parq_form')->Set(['completed', true]);
        	return true;
        }
        return false;
	}

	/* Validates each potential question, and build the query.
	 * if a field fails validation, an error message is returned
	 * if the form successfully validates, the data is saved to the DB
	 * and a success message is returned
	 * $param: 	$questions (a data-structure defining the looping logic),
	 *			$query (the query object used to build the insert query)
	 */ 
	private function validateParQFieldsAndBuildQuery($query)
	{
		$f = $this->form;
		if (isset($f["userID"]))
			$query->Set(["userID", $f["userID"]]);
		// define a structure that will help loop through potential questions
		$questions = array(
					"section1" => 7,
				  	"section2" => array(
				  					"q2_1" => 3, "q2_2" => 2,
				  					"q2_3" => 5, "q2_4" => 3,
				  					"q2_5" => 2, "q2_6" => 4,
				  					"q2_7" => 3, "q2_8" => 3,
				  					"q2_9" => 3),
				  	"section3" => 3);
		$opts = ["Yes", "No"];
		// section 1 		
		for ($i = 1; $i <= $questions["section1"]; $i++)
		{
			$name = "q1_$i";
			if (isset($f[$name]))
			{
				if ($this->validateRadioButton($f[$name], $opts))
					$query->Set([$name, $f[$name]]);
				else
					return false;
			}
			else
				return false;
		}
		// section2
		for ($i = 1; $i <= sizeof($questions["section2"]); $i++)
		{
			$name = "q2_$i";
			if(isset($f[$name]))
			{
				if ($this->validateRadioButton($f[$name], $opts))
				{
					$query->Set([$name, $f[$name]]);
					if ($f[$name] === "No")
						continue;	
				}
				else
					return false;
				
			}				

			for ($j = 1; $j <= $questions["section2"][$name]; $j++)
			{
				$subname = $name."_$j";	
				if (isset($f[$subname]))
				{
					if ($this->validateRadioButton($f[$subname], $opts))
						$query->Set([$subname, $f[$subname]]);
					else
						return false;
				}					
			}
		}
		//section3
		for ($i = 1; $i <= $questions["section3"]; $i++)
		{
			$name = "q3_$i";
			$maxLength = 50;
			if (isset($f[$name]))
			{
				if ($this->checkForIllegalCharacters($f[$name]) && $this->validateValueLength($f[$name], $maxLength))
					$query->Set([$name, $f[$name]]);
			}		
			else
				return false;
		}		
		return $query;
	}
}
