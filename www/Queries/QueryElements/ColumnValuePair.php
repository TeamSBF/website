<?php
class ColumnValuePair
{
    protected $column;
    protected $value;

    public function __construct($column, $value)
    {
        $this->column = $column;
        $this->value = $value;
    }

    public function Column()
    {
        return $this->column;
    }

    public function Value()
    {
        return $this->value;
    }
}