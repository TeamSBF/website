<?php
class CVOCPair extends CVPair
{
    // ---
    private static $valid_conditions = array("AND", "OR","");
    // ---

    protected $operator;
    protected $condition;

    public function __construct($column, $value, $operator, $condition)
    {
        $condition = strtoupper($condition);
        if(!in_array($condition, self::$valid_conditions))
            throw new Exception("'$condition' is not a valid condition");

        parent::__construct($column, $value);
        $this->operator = $operator;
        $this->condition = $condition;
    }

    public function Operator()
    {
        return $this->operator;
    }

    public function Condition()
    {
        return $this->condition;
    }
}