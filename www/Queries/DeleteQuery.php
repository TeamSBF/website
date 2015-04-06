<?php
class DeleteQuery extends AbstractQuery
{
    private $conditions;
    private $where;
    private $limit;

    public function __construct()
    {
        parent::__construct();
        $this->conditions = 0;
        $this->where = [];
        $this->limit = 0;
    }

    public function From($tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function Where($column, $operator, $value, $condition = null)
    {
        if($condition != null)
            $this->conditions++;

        $e = new WhereElement($column, $operator, $value, $condition);
        $this->where[count($this->where)] = $e;
        return $this;
    }

    public function Limit($num)
    {
        if(!is_numeric($num))
            throw new Exception("The limit('$num') must be a number");

        $this->limit = $num;
    }

    public function Query()
    {
        $query = "DELETE FROM `" . $this->table . "`";
        $query .= " WHERE " . $this->parseWhere();

        if($this->limit > 0)
            $query.= " LIMIT " . $this->limit;

        return [$query, $this->where];
    }

    private function parseWhere()
    {
        $where = "";
        $elements = count($this->where);

        for($i = 0; $i < $elements; $i++)
        {
            $where .= $this->where[$i]->Where();
        }

        return $where;
    }
}

//DELETE FROM `sbf_database`.`users` WHERE `users`.`id` = 20