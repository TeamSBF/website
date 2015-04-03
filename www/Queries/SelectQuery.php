<?php
class SelectQuery
{
	private $select;
	private $from;
	private $where;
	
	public function __construct()
	{
		$this->select = [];
		$this->from = [];
		$this->where = [];
	}
	
	public function Select()
	{
		$this->select = getArgs(funct_get_args());
	}
	
	public function From()
	{
		$this->from = getArgs(func_get_args());
	}
	
	public function Where()
	{
		
	}
	
	private function getArgs($args)
	{
		$ret = [];
		foreach($args as $arg)
		{
			$count = count($ret);
			$ret[$count] = $arg;
		}
		
		return $ret;
	}
}