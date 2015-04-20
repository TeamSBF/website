<?php
/**
 * A field class that allows for the name, type, and value association.
 */
class Field
{
    // ---
    //private static $keys = ["primary" => "", "unique" => []];
    // ---

    /**
     * The field name
     *
     * @var string
     */
    private $name;
    /**
     * The field type
     *
     * @var string
     */
    private $type;
    /**
     * The field default value
     *
     * @var mixed
     */
    private $value;

    private $default;

    /**
     * @param $name
     * @param $type
     * @param $value
     * @param $default
     */
    public function __construct($name, $type, $value, $default = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function Name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function Type()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function Value()
    {
        return $this->value;
    }

    public function DefaultValue()
    {
        return $this->default;
    }
}