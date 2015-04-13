<?php
class InsertSet extends Set
{
    protected function format($values = false)
    {
        $query = "";
        $cvs = [];

        $count = count($this->sets);
        $cols = "(";
        $vals = "VALUES(";
        for ($i = 0; $i < $count; $i++) {
            $set = $this->sets[$i];
            $cols .= "`" . $set->Column() . "`";
            $ret = self::parseValue($values, $set->Column(), $set->Value());
            $vals .= $ret[1];

            if ($ret[0])
                $cvs[count($cvs)] = new CVPair($set->Column(), $set->Value());

            if ($i < $count - 1) {
                $cols .= ", ";
                $vals .= ", ";
            }
        }

        $cols .= ")";
        $vals .= ")";
        $query = $cols . " " . $vals;

        return [$query, $cvs];
    }
}