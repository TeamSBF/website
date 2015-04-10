<?php
class Query
{
    private $reqs;

    public function __construct($reqs)
    {
        $this->reqs = [];

        $pieces = $reqs["pieces"];
        foreach($pieces as $piece)
        {
            $name = get_class($piece);
            $this->reqs[strtolower($name)] = $piece;
        }
        //printr($this->reqs);
    }

    public function __call($func, $params)
    {
        $obj = strtolower($func);
        if ($obj == "from" || $obj == "into" || $obj == "table") {
            $func = "Table";
            $obj = strtolower($func);
        }

        if (array_key_exists($obj, $this->reqs))
            $this->reqs[$obj]->$func($params);
        else
            throw new Exception("No method name like that exists.");

        return $this;
    }

    public function Query()
    {
        $query = "";

        foreach ($this->reqs as $req) {
            $query .= " " . $req->Query();
        }
        return $query;
    }
}