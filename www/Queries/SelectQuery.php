<?php
class SelectQuery extends AbstractQuery
{
    private $select;
    private $whereElements;
    private $conditions;
    private $limit;

    public function __construct()
    {
        parent::__construct();
        $this->select = [];
        $this->whereElements = [];
        $this->conditions = 0;
        $this->limit = 0;
    }

    public function Select($items)
    {

        $this->select = $items;
        return $this;
    }

    public function Where($column, $operator, $value, $condition = null)
    {
        if($condition != null)
            $this->conditions++;

        $e = new WhereElement($column, $operator, $value, $condition);
        $this->whereElements[count($this->whereElements)] = $e;
        return $this;
    }

    public function Limit($limit)
    {
        if (!is_numeric($limit))
            throw new Exception("The limit must be a number: '$limit'");

        $this->limit = $limit;
        return $this;
    }

    public function Query()
    {
        $this->checkCounts();

        $query = "SELECT " . $this->parseInfo($this->select);
        $query .= " FROM " . $this->table;
        if (count($this->whereElements) > 0)
            $query .= " WHERE " . $this->parseWhere();

        if ($this->limit > 0)
            $query .= " LIMIT " . $this->limit;

        return [$query, $this->whereElements];
    }

    private function checkCounts()
    {
        $elementCount = count($this->whereElements);

        if(abs($elementCount - $this->conditions) != 1)
            throw new Exception("Query does not contain the correct number of WHERE clause conditionals.");
    }

    private function parseInfo($arr)
    {
        $info = "";

        for ($i = 0; $i < count($arr); $i++) {
            $info .= "`" . $arr[$i] . "`";
            if ($i < count($arr) - 1)
                $info .= ", ";
        }

        return $info;
    }

    private function parseWhere()
    {
        $columns = "";
        $elements = count($this->whereElements);

        for ($i = 0; $i < $elements; $i++) {
            $columns .= $this->whereElements[$i]->Where();
        }

        return $columns;
    }
}