<?php
class UpdateQuery extends AbstractNonSelectQuery
{
    private $whereElements;
    private $conditions;
    private $limit;

    public function __construct()
    {
        parent::__construct();
        $this->whereElements = [];
        $this->conditions = 0;
        $this->limit = 0;
    }

    public function Where($column, $operator, $value, $condition = null)
    {
        if ($condition != null)
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

        $query = "UPDATE `" . $this->table . "`";
        $set = $this->parseSet();
        $query .= " SET " . $set[0];
        $query .= " WHERE " . $this->parseWhere();

        return [$query, array_merge($set[1], $this->whereElements)];
    }

//UPDATE `sbf_database`.`users` SET `salt` = 'erbveredfvev', `created` = UNIX_TIMESTAMP(),
// `activated` = '1' WHERE `users`.`id` = 1;
    protected function parseSet()
    {
        $ret = "";
        $colvals = [];

        $cols = count($this->colvals);
        for ($i = 0; $i < $cols; $i++) {
            $col = $this->colvals[$i]->Column();
            $val = $this->colvals[$i]->Value();
            $ret .= "`" . $col . "` = ";

            if (strpos($val, '(')) {
                $ret .= $val;
            } else {
                $colvals[count($colvals)] = new ColumnValuePair($col, $val);
                $ret .= ":" . $col;
            }

            if ($i < $cols - 1)
                $ret .= ", ";
        }


        return [$ret, $colvals];
    }

    private function checkCounts()
    {
        $elements = count($this->whereElements);

        if ($elements < 1)
            throw new Exception("Update must contain at least 1 WHERE specifier");

        if (abs($elements - $this->conditions) != 1)
            throw new Exception("Query does not contain the correct number of WHERE clause conditionals.");
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

    private function parseInfo($cols)
    {
        $ret = "";
        for ($i = 0; $i < count($cols); $i++) {
            $ret .= "`" . $cols[$i] . "` = :" . $cols[$i];
            if ($i < count($cols) - 1)
                $ret .= ", ";
        }
        return $ret;
    }
}