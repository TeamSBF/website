<?php
abstract class AbstractNonSelectQuery extends AbstractQuery
{
    protected $colvals;

    public function __construct()
    {
        parent::__construct();
        $this->colvals = [];
    }

    public function Set($column, $value)
    {
        $this->colvals[count($this->colvals)] = new ColumnValuePair($column, $value);
        return $this;
    }

    protected abstract function parseSet();
}