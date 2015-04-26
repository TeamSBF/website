<?php

class FormsModelTemp
{
	private $form;
	public function __construct($data)
	{
		$this->form = $data;
	}

	public function ValidateEnrollment()
	{
		// do some checks here
		//if($empties = $this->CheckforEmpties() != "")
			//return $empties;


		// if everything went well we save data to the database
		if ($this->saveDbEnrollment())
			return true;
		return false;
	}

	public function ValidateQuestionnaireP1()
	{
		// do some checks here

		// if everything went well we save data to the database
		if ($this->saveDbQuestionnaireP1())
			return '***Success!***';
		return "***DB SAVE FAILED***";
	}

	public function ValidateQuestionnaireP2()
	{
		// do some checks here

		// if everything went well we save data to the database
		if ($this->saveDbQuestionnaireP2())
			return '***Success!***';
		return "***DB SAVE FAILED***";
	}

	public function ValidateParQ()
	{
		// do some checks here
		// if everything went well we save data to the database
		
		if ($this->saveDbParQ())
			return '***Success!***';
		return "***DB SAVE FAILED***"; 
	}

	private function CheckforEmpties()
	{
		for ($i = 0; $i < $this->form->length; $i++)
		{
			if ($this->form[i] == "")
				return 'Some required fields are missing, every field preceded by a * are required';
		}
		return "";
	}

	private function CheckForIllegalCharacters($str)
	{
		return !preg_match('/[^A-Za-z0-9.!\\-$\']/', $str);

	}

	private function ValidateValueLength($value, $length)
	{
		if (strlen($value) > $length)
			return false;
		return true;
	}

	private function ValidateEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		return false;
	}

	private function ValidateDate($date, $format = 'Y-m-d')
	{
    	$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

	private function ValidatePhone($phone)
	{
		//TO DO
	}

	private function saveDbEnrollment()
	{
		$form = $this->form;
		$id = $_SESSION['user']->__get('id');
		$complete = true;//----------------------------------temporary 
		// get a Insert query object
		$insert = QueryFactory::Build('insert');
		// build the query
        $insert->Into('enrollment_form')->Set(['lastName', $form['lName']], ['firstName', $form['fName']], ['streetAddress', $form['streetAddress']],
        	['city', $form['city']], ['phone', $form['phone']], ['email', $form['email']], ['dob', $form['dob']], ['gender', $form['gender']],
        	['healthHistory', $form['healthHistory']], ['watchSbf', $form['watchSbf']], ['howManyTimesAWeek', $form['howMany']],
        	['controlGroup', $form['controlGrp']], ['experimentalGroup', $form['experimentalGrp']] , ['userId',$id], ['enrollmentCompleted',$complete]);
        
        // save to the DB
        $qinfo = DatabaseManager::Query($insert);
        // check for success or failure
        if ($qinfo->RowCount() == 1)
            return true;

        return false;
	}

	private function saveDbQuestionnaireP1()
	{
		//TO DO
	}

	private function saveDbQuestionnaireP2()
	{
		//TO DO
	}

	private function saveDbParQ()
	{
		$form = $this->form;
		// get a Insert query object
		$insert = QueryFactory::Build('insert');
		// build the query
		// NOT WORKING!!!
        $insert->Into('parq_form')->Set(['q1-1', $form['q1-1']], ['q1-2', $form['q1-2']], ['q1-3', $form['q1-3']],
        	['q1-4', $form['q1-4']], ['q1-5', $form['q1-5']], ['q1-6', $form['q1-6']], ['q1-7', $form['q1-7']], ['q2-1', $form['q2-1']],
        	['q2-1a', $form['healthHistory']], ['watchSbf', $form['watchSbf']], ['howManyTimesAWeek', $form['howMany']],
        	['controlGroup', $form['controlGrp']], ['experimentalGroup', $form['experimentalGrp']]);
        
        // save to the DB
        $qinfo = DatabaseManager::Query($insert);
        // check for success or failure
        if ($qinfo->RowCount() == 1)
            return true;

        return false;
	}

	private function validateParQFields()
	{
		$f = $this->form;
		

	}
	
	//=========================================================================================================================
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
