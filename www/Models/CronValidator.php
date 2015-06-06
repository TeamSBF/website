<?php

class CronValidator
{
    private $formInfo;
	private $max = 60;
	
    public function __construct($info)
    {
        $this->formInfo = $info;
    }
	
	//returns the max value
	public static function Max()
	{
		return $max;
	}
	
	//public access to validate form info
	public function Validate()
	{
		$enabled=-1;
		$err="";
		if(isset($this->formInfo["enabled"]))
		{
			$enabled = 1;
		}
		else
		{
			$enabled = 0;
		}
		//change activation times
		if($this->formInfo["submit"]=="activation duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_activation",$enabled);
		}
		//change form life
		else if($this->formInfo["submit"]=="forms duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_form",$enabled);
		}
		//change assessment frequency
		else if($this->formInfo["submit"]=="assessment frequency")
		{
			$err = $this->prv_validate();
			if(!$err)
			{
				$err = $this->set("ttl_assessment_frequency",$enabled);
			}
		}
		//change assessment life
		else if($this->formInfo["submit"]=="assessment duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_assessment_complete",$enabled);
		}
		//change assessment choice life
		else if($this->formInfo["submit"]=="assessment choice duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_assessment_choice",$enabled);
		}
		//change password life
		else if($this->formInfo["submit"]=="forgot password duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("forgotpassword",$enabled);
		}
		return $err;
	}

	//private helper method to validate
	private function prv_validate()
	{
		unset($this->formInfo["submit"]);
		foreach($this->formInfo as $curr)
		{
			//makes all valuse an integer
			settype($curr, "integer");
			if($curr < 0 && $curr < $this->max+1)
				return "*number must be greater then 0 less then 10000*";
		}
		return false;
	}
	
	//update database with the submited information
	private function set($name,$enabled)
	{	
		//format string
		$str= $this->formatString();

		//update
		$update = QueryFactory::Build('update');
		$update->Table('settings')->Set(['enabled',$enabled])->Where(['name', '=',$name]);
		if(strlen($str) > 2)
		{
			$update->Table('settings')->Set(['value',$str ]);
		}
		$cinfo = DatabaseManager::Query($update);
		if($cinfo->RowCount() != 1)
			return "our servers are having issues please try again later";
		return false;
	}
	
	//formats the string to work in strtotime method
	private function formatString()
	{
		$str = "+ ";
		foreach($this->formInfo as $key=>$curr)
		{
			if($curr > 0)
				$str = $str . $curr ." " . $key ." ";
		}
		return $str;
	}

}