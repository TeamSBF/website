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
		if($empties = $this->CheckforEmpties() != "")
			return $empties;


		// if everything went well we save data to the database
		if ($this->saveDbEnrollment())
			return '***Success!***';
		return "***FAILED TO SAVE TO DB***";
	}

	public function ValidateQuestionnaireP1()
	{
		// do some checks here

		// if everything went well we save data to the database
		$this->saveDbQuestionnaireP1();
		return "Success!";
	}

	public function ValidateQuestionnaireP2()
	{
		// do some checks here

		// if everything went well we save data to the database
		$this->saveDbQuestionnaireP2();
		return "Success!";
	}

	public function ValidateParQ()
	{
		// do some checks here

		// if everything went well we save data to the database
		$this->saveDbParQ();
		return "Success!";
	}

	private function CheckforEmpties()
	{
		for ($i = 0; $i < $array->length; $i++)
		{
			if ($this->form[i] == "")
				return 'Some required fields are missing, every field preceded by a * are required';
		}
		return "";
	}

	private function CheckForIllegalCharacters($str)
	{
		return !preg_match('/[^A-Za-z0-9.#\\-$\']/', $str);

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
		$insert = new InsertQuery();
        $insert->Table("enrollment_form")->Set("lastName", $form['lName'])->Set("firstName", $form['fName'])
        ->Set("streetAddress", $form['streetAddress'])->Set("city", $form['city'])->Set("phone", $form['phone'])
        ->Set("email", $form['email'])->Set("dob", $form['dob'])->Set("gender", $form['gender'])
        ->Set("healthHistory", $form['healthHistory'])->Set("watchSbf", $form['watchSbf'])->Set("howManyTimesAWeek", $form['howMany'])
        ->Set("controlGroup", $form['controlGrp'])->Set("experimentalGroup", $form['experimentalGrp']);
        
        $qinfo = DatabaseManager::Query($insert);

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