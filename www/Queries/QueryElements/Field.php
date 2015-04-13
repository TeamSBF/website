<?php
class Field
{
    // ---
    //private static $keys = ["primary" => "", "unique" => []];
    // ---

    private $name;
    private $type;
    private $value;

    public function __construct($name, $type, $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function Name()
    {
        return $this->name;
    }

    public function Type()
    {
        return $this->type;
    }

    public function Value()
    {
        return $this->value;
    }
}