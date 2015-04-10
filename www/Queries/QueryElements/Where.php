<?php
class Where
{
    private $where;

    public function __construct()
    {
        $this->where = [];
    }

    public function Where($arr)
    {
        //printr($arr);
        foreach($arr as $where)
        {
            //printr($where);
            if(count($where) < 4)
                $where[3] = "";

            $this->where[count($this->where)] = new CVOCPair($where[0],$where[2],$where[1],$where[3]);
        }

        printr($this->where);
    }

    public function Query()
    {
        $query = "WHERE ";

        $count = count($this->where);
        for($i = 0; $i < $count; $i++)
        {
            $where = $this->where[$i];

            $query .= "`" . $where->Column() . "` " . $where->Operator() . " " . $where->Value();
            if(!self::isEmpty($where->Condition())) {
                $query .= " " . $where->Condition();
            }
            if($i < $count - 1)
                $query .= " ";
        }

        return $query;
    }

    private static function isEmpty($element)
    {
        return (!isset($element) || trim($element)==='');
    }
}