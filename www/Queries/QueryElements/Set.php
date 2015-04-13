<?php
abstract class Set
{
    protected $sets;

    public function __construct()
    {
        $this->sets = [];
    }

    public function Set($arr)
    {
        foreach($arr as $element) {
            $this->sets[count($this->sets)] = new CVPair($element[0], $element[1]);
        }
    }

    public function Query($values = false)
    {
        $ret = $this->format($values);
        $query = $ret[0];
        if($values)
            return $query;

        return [$query, $ret[1]];
    }

    protected static function parseValue($values, $column, $value)
    {
        $val = "";
        if ($values) {
            if (is_numeric($value))
                $val = $value;
            else
                $val = "'" . $value . "'";
        } else
            $val = ":" . $column;

        if (strpos($value, "()"))
            return [false, $value];

        return [true, $val];
    }

    protected abstract function format($values);
}