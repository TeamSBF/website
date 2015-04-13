<?php
class UpdateSet extends Set
{
    protected function format($values = false)
    {
        $query = "SET ";
        $cvs = [];

        $count = count($this->sets);
        for($i = 0; $i < $count; $i++)
        {
            $set = $this->sets[$i];
            $query .= $set->Column() . " = ";
            $ret = self::parseValue($values, $set->Column(), $set->Value());
            $query .= $ret[1];

            if ($ret[0])
                $cvs[count($cvs)] = new CVPair($set->Column(), $set->Value());

            if($i < $count - 1)
                $query .= ", ";
        }

        return [$query, $cvs];
    }
}