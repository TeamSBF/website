<?php
abstract class AbstractQuery implements IQuery
{
    protected $table;

    protected function __construct()
    {
        $this->table = "";
    }

    public function Table($tableName = null)
    {
        if($tableName == null)
            return $this->table;

        if (!is_string($tableName))
            return;

        $this->table = $tableName;
        return $this;
    }

    abstract public function Query();
}