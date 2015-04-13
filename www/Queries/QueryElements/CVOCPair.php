<?php
/*
 * A class that represents the association between a Column, Value, Operator, and Condition (CVOC)
 * EX: `column1` = 'value1' AND `column2` >= 'value2'
 * Where column1 and column2 are columns, value1 and value2 are values, = and >= are operators
 * and AND is the condition
 */
class CVOCPair extends CVPair
{
    // ---
    /*
     * A list of valid conditions that the $condition variable can store (replace with enum?)
     *
     * @var array
     */
    private static $valid_conditions = array("AND", "OR","");
    // ---

    /*
     * The operator for the CVOC
     *
     * @var string
     */
    protected $operator;
    /*
     * The conditional used to bridge multiple statements together (primarily used for Where)
     *
     * @var string
     */
    protected $condition;

    /*
     * The class constructor
     *
     * @param string $column The column aspect of the CVOCPair
     * @param string $value The value aspect of the CVOCPair
     */
    public function __construct($column, $value, $operator, $condition)
    {
        // Make it upper case to make it easier
        $condition = strtoupper($condition);
        // If the given condition is not an allowed condition, throw an exception
        if(!in_array($condition, self::$valid_conditions))
            throw new Exception("'$condition' is not a valid condition");

        // Call the parents constructor as this one only implements the OC part of CVOC
        parent::__construct($column, $value);
        // Store the values
        $this->operator = $operator;
        $this->condition = $condition;
    }

    /*
     * Getter
     */
    public function Operator()
    {
        return $this->operator;
    }

    /*
     * Getter
     */
    public function Condition()
    {
        return $this->condition;
    }
}