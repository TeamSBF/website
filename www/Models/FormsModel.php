<?php

/*
*	FormsModel.php: Validates form data, build insert queries, and save to the database.
*	One entry point (function) per Form
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
		 return $this->validateAndSaveEnrollment();
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

	/* Checks if some input contains character we don't want */
	private function checkForIllegalCharacters($str)
	{
		return preg_match('/[^A-Za-z0-9.!?\\-$\']/', $str);
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
		return preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone);
	}

	/* Check if a given string exists and not longer than a given length
	 * $param: 	$value (string),
	 *			$length (int),
	 *			$isREquired (bool)
	 */
	private function isStringFieldValid($value, $length, $isRequired)
	{
		if (isset($this->form[$value]))
		{
			if (!$this->validateValueLength($this->form[$value], $length) && !$this->checkForIllegalCharacters($this->form[$value]))
				return false;
			return true;
		}
		else
			return !$isRequired;
	}

	/* Validates the enrollment form data, build the insert query and save to the database */
	private function validateAndSaveEnrollment()
	{
		$form = $this->form;

		// validate the fields
		if (($r = $this->validateEnrollmentFields()) != "success")
			return $r;

		// get a Insert query object
		$insert = QueryFactory::Build('insert');
		// build the query
        $insert->Into('enrollment_form')->Set(['userID', $form['userID']])->Set(['lastName', $form['lName']], ['firstName', $form['fName']], ['streetAddress', $form['streetAddress']],
        	['city', $form['city']], ['phone', $form['phone']], ['email', $form['email']], ['dob', $form['dob']], ['gender', $form['gender']],
        	['healthHistory', $form['healthHistory']], ['watchSbf', $form['watchSbf']], ['howManyTimesAWeek', $form['howMany']],
        	['controlGroup', $form['controlGrp']], ['experimentalGroup', $form['experimentalGrp']] , ['userId',$id], ['completed',$complete]);
        
        // save to the DB
        $qinfo = DatabaseManager::Query($insert);
        // check for success or failure
        if ($qinfo->RowCount() == 1)
        {
        	$complete = QueryFactory::Build('update');
        	$complete->Table('enrollment_form')->Set(['completed', 1])->Where(['userID', '=', $this->form['userID']]);
        	$cinfo = DatabaseManager::Query($complete);
        	if ($cinfo->RowCount() == 1)
        		return "success";
        }

        return false;
	}

	/* Validates the enrollment form fields */
	private function validateEnrollmentFields()
	{
		$f = $this->form;
		$nameLength = 50;
		$addressLength = 150;
		$emailLength = 100;
		$textAreaLength = 500;
		$dateLength = 10;

		if (!($this->isStringFieldValid('lName', $nameLength, true))) 
			return "Last Name invalid";
		if (!$this->isStringFieldValid('fName', $nameLength, true)) 
			return "First Name invalid";
		if (!$this->isStringFieldValid('streetAddress', $addressLength, false)) 
			return "Street Address invalid";
		if (!$this->isStringFieldValid('city', $nameLength, false)) 
			return "City invalid";
		if (!$this->isStringFieldValid('healthHistory', $textAreaLength, false)) 
			return "Health history invalid (only alpha-numeric characters and limited to 500 characters)";
		if (isset($f['phone']))
		{
			if (!$this->ValidatePhone($f['phone']))
				return "Phone Number format invalid.";	
		}
		if (isset($f['email']))
		{
			if (!$this->validateEmail($f['email']) && !$this->validateValueLength($f['email'], $emailLength))
				return "Email invalid";
		}
		else
			return "Email invalid";
		if (isset($f['dob']))
		{
			if (!$this->validateDate($f['dob']) && !$this->validateValueLength($f[$value], $dateLength))
				return "Date invalid";
		}
		else
			return false;
		if (isset($f['gender']))
		{
			if (!$this->validateRadioButton($f['gender'], ["Male", "Female"]))
				return "Bad Gender";
		}
		else
			return "Bad Gender";
		if (isset($f['watchSbf']))
		{
			if (!$this->validateRadioButton($f['watchSbf'], ["Yes", "No"]))
				return "Bad Watchsbf";
		}
		else
			return "Bad watchsbf";
		if (isset($f['howMany']))
		{
			if (!($f['howMany'] > -1) && !($f['howmany'] < 101))
				return "Bad howmany";
		}
		if (isset($f['controlGrp']))
		{
			if (!$this->validateRadioButton($f['controlGrp'], ["Yes", "No"]))
				return "Bad ControlGrp";
		}
		if (isset($f['experimentalGrp']))
		{
			if (!$this->validateRadioButton($f['experimentalGrp'], ["Yes", "No"]))
				return "Bad Experimental";
		}
		// if we made it this far, data is valid, return true
		return "success";		
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
        	$complete = QueryFactory::Build('update');
        	$complete->Table('parq_form')->Set(['completed', 1])->Where(['userID', '=', $this->form['userID']]);
        	$cinfo = DatabaseManager::Query($complete);
        	if ($cinfo->RowCount() == 1)
        		return "sucess";
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
	
	//==================================================
		public static function isEnrollmentComplete()
	{
		$id = $_SESSION['user']->__get('id');
		
		
		$select = QueryFactory::Build("select");
		$select->Select('completed')->Table('enrollment_form')->Where(['userID','=', $id])->Limit();
		$res = DatabaseManager::Query($select);
		$resultArray = $res->Result();

		if ($res->RowCount() == 1)
		{

			return $res;
		}
		return false;
	}
	
	public static function isParQComplete()
	{
		$id = $_SESSION['user']->__get('id');
		
		$select = QueryFactory::Build("select");
		$select->Select('completed')->Table('parq_form')->Where(['userID','=', $id])->Limit();
		$res = DatabaseManager::Query($select);
		$resultArray = $res->Result();

		if ($res->RowCount() == 1)
		{

			return $res;
		}
		return false;
	}
	public static function isQues1Complete()
	{
		$id = $_SESSION['user']->__get('id');
		
		$select = QueryFactory::Build("select");
		$select->Select('completed')->Table('questionnaireP1_form')->Where(['userID','=', $id])->Limit();
		$res = DatabaseManager::Query($select);
		$resultArray = $res->Result();

		if ($res->RowCount() == 1)
		{

			return $res;
		}
		return false;
	}
	
	public static function isQues2Complete()
	{
		$id = $_SESSION['user']->__get('id');
		
		$select = QueryFactory::Build("select");
		$select->Select('completed')->Table('questionnaireP2_form')->Where(['userID','=', $id])->Limit();
		$res = DatabaseManager::Query($select);
		$resultArray = $res->Result();

		if ($res->RowCount() == 1)
		{

			return $res;
		}
		return false;
	}
}
