<?php

class FormsModel
{
	private $array;
	public function __construct($data)
	{
		$array = $data;
	}

	public function ValidateEnrollment()
	{
		// do some checks here

		// if everything went well we save data to the database
		$this->saveDbEnrollment();
		return 'Success!';
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

	private function CheckforEmpties($array)
	{
		for ($i = 0; $i < $array->length; $i++)
		{
			if ($array[i] == "")
				return 'Some required fields are missing, every field preceded by a * are required';
		}
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

	}

	private function saveDbEnrollment()
	{

	}

	private function saveDbQuestionnaireP1()
	{

	}

	private function saveDbQuestionnaireP2()
	{

	}

	private function saveDbParQ()
	{

	}
}
