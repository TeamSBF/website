<?php
class Where
{
    private $where;

    public function __construct()
    {
        $this->where = [];
    }

    public function Where($arr, $clear = true)
    {
        if($clear)
            $this->where = [];

        //printr($arr);
        foreach($arr as $where)
        {
            //printr($where);
            if(count($where) < 4)
                $where[3] = "";

            $this->where[count($this->where)] = new CVOCPair($where[0],$where[2],$where[1],$where[3]);
        }
    }

    public function Query($values = false)
    {
        $count = count($this->where);
        if($count < 1)
            return "";

        $query = "WHERE ";
        for ($i = 0; $i < $count; $i++) {
            $where = $this->where[$i];

            $query .= "`" . $where->Column() . "` " . $where->Operator();
            $query .= " " . ((!$values) ? ":" . $where->Column() : "'".$where->Value()."'");

            if (!self::isEmpty($where->Condition())) {
                $query .= " " . $where->Condition();
            }
            if ($i < $count - 1)
                $query .= " ";
        }

        if($values)
            return $query;

        return [$query, $this->where];
    }

    private static function isEmpty($element)
    {
        return (!isset($element) || trim($element)==='');
    }
}