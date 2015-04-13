<?php
class Query implements IQuery
{
    // ---
    private static $translatedNames = ["from"=>"Table", "into"=>"Table"];
    // ---

    private $pieces;

    public function __construct($pieces)
    {
        //printr($pieces);
        $this->pieces = [];

        foreach ($pieces as $piece) {
            $name = (!is_subclass_of($piece, "Set")) ? get_class($piece) : get_parent_class($piece);
            $this->pieces[strtolower($name)] = $piece;
        }
        //printr($this->pieces);
    }

    public function __call($func, $params)
    {
        $ret = "";
        $obj = strtolower($func);
        if (array_key_exists($obj, self::$translatedNames)) {
            $func = self::$translatedNames[$obj];
            $obj = strtolower($func);
        }

        if (array_key_exists($obj, $this->pieces)) {
            $ret = $this->pieces[$obj]->$func($params);
            if(!empty($params))
                $ret = $this;
        }else
            throw new Exception("Method name('$func') does not exist.");

        return $ret;
    }

    public function Query($values = false)
    {
        $query = "";
        $cvs = [];

        foreach ($this->pieces as $piece) {
            $q = $piece->Query($values);
            if (!is_array($q)) {
                $query .= " " . $q;
            } else {
                $query .= " " . $q[0];
                $cvs = array_merge($q[1], $cvs);
            }

        }
        return [$query, $cvs];
    }
}