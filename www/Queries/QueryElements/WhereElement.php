<?php
class WhereElement extends ColumnValuePair
{
    private static $valid_conditions = array("AND", "OR");

    private $operator;
    private $cond;

    public function __construct($column, $operator, $value, $condition = null)
    {
        parent::__construct($column, $value);

        $condition = strtoupper($condition);
        if ($condition != null && !in_array($condition, self::$valid_conditions))
            throw new Exception("Condition('$condition') is not allowed");

        $this->operator = $operator;
        $this->cond = $condition;
    }

    public function Operator()
    {
        return $this->operator;
    }

    public function Where()
    {
        $where = "`" . $this->column . "` " . $this->operator . " :" . $this->column;
        if ($this->cond != null)
            $where .= " " . $this->cond;

        return $where . " ";
    }
}