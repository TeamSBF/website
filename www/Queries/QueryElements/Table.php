<?php
class Table
{
    private $table;

    public function __construct($name = null)
    {
        $this->table = $name;
    }

    public function Table($name = null)
    {
        if($name == null)
            return $this->table;

        if (is_array($name))
            $name = $name[0];

        $this->table = $name;
    }

    public function Query()
    {
        return "`" . $this->table . "`";
    }

    /*public function IsEmpty()
    {
        return (!isset($this->table) || trim($this->table)==='');
    }*/
}