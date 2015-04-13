<?php
/*
 * A field class that allows for the name, type, and value association.
 */
class Field
{
    // ---
    //private static $keys = ["primary" => "", "unique" => []];
    // ---

    /*
     * The field name
     *
     * @var string
     */
    private $name;
    /*
     * The field type
     *
     * @var string
     */
    private $type;
    /*
     * The field default value
     *
     * @var mixed
     */
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