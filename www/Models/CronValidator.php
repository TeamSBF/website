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
		$err="";
		
		if($this->formInfo["submit"]=="submit activation")//----------------------
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_activation");
		}
		else if($this->formInfo["submit"]=="submit form")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_form");
		}
		else if($this->formInfo["submit"]=="submit assessment")
		{
			$err = $this->prv_validate();
			if(!$err)
				$err = $this->set("ttl_assessment_frequency");
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
	
	private function set($name)
	{	
		//format string
		$str= $this->formatString();
		
		//update
//		echo strlen($str);
		if(strlen($str) > 2)
		{
		$update = QueryFactory::Build('update');
        $update->Table('settings')->Set(['value',$str ])->Where(['name', '=',$name]);
        $cinfo = DatabaseManager::Query($update);
		if($cinfo->RowCount() != 1)
			return "our servers are having issues please try again later";
		return false;
		}
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