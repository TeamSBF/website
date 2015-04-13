<?php

class FormsModel
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
			return '***Success!***';
		return "***DB SAVE FAILED***";
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
		// get a Insert query object
		$insert = QueryFactory::Build("insert");
		// build the query
        $insert->Into("enrollment_form")->Set(["lastName", $form['lName']], ["firstName", $form['fName']], ["streetAddress", $form['streetAddress']],
        	["city", $form['city']], ["phone", $form['phone']], ["email", $form['email']], ["dob", $form['dob']], ["gender", $form['gender']],
        	["healthHistory", $form['healthHistory']], ["watchSbf", $form['watchSbf']], ["howManyTimesAWeek", $form['howMany']],
        	["controlGroup", $form['controlGrp']], ["experimentalGroup", $form['experimentalGrp']]);
        
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
		//TO DO
	}
}
/*
$table = new CreateTableQuery("enrollment_form");
$table->AddColumn('id')->SetAutoIncrement();
$table->AddColumn('lastName')->MakeVarChar(50);
$table->AddColumn('firstName')->MakeVarChar(50);
$table->AddColumn('streetAddress')->MakeVarChar(120);
$table->AddColumn('city')->MakeVarChar(50);
$table->AddColumn('phone')->MakeVarChar(20);
$table->AddColumn('email')->MakeVarChar(100)->AddKey('unique');
$table->AddColumn('dob')->MakeVarChar(10)->DefaultValue('false');
$table->AddColumn('gender')->MakeBool()->DefaultValue('false');
$table->AddColumn('healthHistory')->MakeVarChar(500)->DefaultValue('false');
$table->AddColumn('watchSbf')->MakeBool()->DefaultValue('false');
$table->AddColumn('HowManyTimesAWeek')->MakeInt()->DefaultValue(0);
$table->AddColumn('controlGroup')->MakeBool()->DefaultValue('false');
$table->AddColumn('experimentalGroup')->MakeBool()->DefaultValue('false');  */