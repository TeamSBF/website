<?php
class Select
{
    private $select;

    public function __construct()
    {
        $this->select = [];
    }

    public function Select($arr)
    {
        if (is_array($arr))
            $this->select = $arr;
    }

    public function Query()
    {
        $query = "SELECT ";
        $count = count($this->select);
        for($i = 0; $i < $count; $i++)
        {
            $query .= "`" . $this->select[$i] . "`";
            if($i < $count - 1)
                $query .= ", ";
        }

        return $query . " FROM";
    }
}