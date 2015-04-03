<?php
class SelectQuery
{
	private $select;
	private $from;
	private $whereColumns;
    private $whereOps;
    private $whereValues;
    private $limit;
	
	public function __construct()
	{
		$this->select = [];
		$this->from = [];
		$this->whereColumns = [];
        $this->whereOps = [];
        $this->whereValues = [];
        $this->limit = 0;
	}
	
	public function Select()
	{
		$this->select = $this->getArgs(func_get_args());
        return $this;
	}
	
	public function From()
	{
		$this->from = $this->getArgs(func_get_args());
        return $this;
	}
	
	public function WhereColumns()
	{
		$this->whereColumns = $this->getArgs(func_get_args());
        return $this;
	}

    public function WhereOperators()
    {
        $this->whereOps = $this->getArgs(func_get_args());
        return $this;
    }

    public function WhereValues()
    {
        $this->whereValues = $this->getArgs(func_get_args());
        return $this;
    }

    public function Limit($limit)
    {
        if(!is_numeric($limit))
            throw new Exception("The limit must be a number: '$limit'");

        $this->limit = $limit;
    }

    public function Query()
    {
        $this->checkCounts();

        $query = "SELECT " . $this->parseInfo($this->select);
        $query .= " FROM " . $this->parseInfo($this->from);
        $query .= " WHERE " . $this->parseColumns();

        if($this->limit > 0)
            $query .= " LIMIT " . $this->limit;

        return [$query, $this->whereColumns, $this->whereValues];
    }

    private function checkCounts()
    {
        $columnCount = count($this->whereColumns);
        $valueCount = count($this->whereValues);
        $opsCount = count($this->whereOps);

        if($valueCount !== $columnCount)
            throw new Exception("WhereColumn(" . $columnCount . ") and WhereValue(" . $valueCount . ") counts do not match.");

        if($opsCount !== $columnCount)
            throw new Exception("WhereOperators(" . $columnCount . ") and WhereValue(" . $opsCount . ") counts do not match.");
    }

    private function parseInfo($arr)
    {
        $info = "";

        for ($i = 0; $i < count($arr); $i++) {
            $info .= "`" . $arr[$i] . "`";
            if ($i < count($arr) - 1)
                $info .= ", ";
        }

        return $info;
    }

    private function parseColumns()
    {
        $columns = "";

        for($i = 0; $i < count($this->whereColumns); $i++)
        {
            $columns .= "`". $this->whereColumns[$i] ."` ";
            $columns .= $this->whereOps[$i];
            $columns .= " :". $this->whereColumns[$i];
        }

        return $columns;
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