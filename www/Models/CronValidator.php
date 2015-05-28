<?php

class CronValidator
{
    private $formInfo;
	private $max = 9999;

    public function __construct($info)
    {
        $this->formInfo = $info;
    }
	
	public static function Max()
	{
		return $max;
	}
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

		if($this->formInfo["submit"]=="submit activation")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_activation",$enabled);
		}
		else if($this->formInfo["submit"]=="submit form")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_form",$enabled);
		}
		else if($this->formInfo["submit"]=="submit assessment frequency")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_assessment_frequency",$enabled);
		}
		else if($this->formInfo["submit"]=="submit assessment duration")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_assessment_complete",$enabled);
		}
		return $err;
	}

	private function prv_validate()
	{
		unset($this->formInfo["submit"]);
		foreach($this->formInfo as $curr)
		{
			//make int
			settype($curr, "integer");
			if($curr < 0 && $curr < $this->max+1)
				return "*number must be greater then 0 less then 10000*";
		}
		return false;
	}
	
	private function set($name,$enabled)
	{	
		//format string
		$str= $this->formatString();

		//update
//		echo strlen($str);
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