<?php
class InsertQuery extends AbstractNonSelectQuery
{
    public function Query()
    {
        $query = "INSERT INTO `" . $this->table . "` ";
        $set = $this->parseSet();
        $query .= $set[0];

        return [$query, $set[1]];
    }

    protected function parseSet()
    {
        $cols = "";
        $vals = "";
        $colvals = [];
        for ($i = 0; $i < count($this->colvals); $i++) {
            $col = $this->colvals[$i]->Column();
            $val = $this->colvals[$i]->Value();

            $cols .= "`" . $col . "`";
            if (strpos($val, '('))
                $vals .= $val;
            else {
                $vals .= ":" . $col;
                $colvals[count($colvals)] = new ColumnValuePair($col, $val);
            }

            if ($i < count($this->colvals) - 1) {
                $cols .= ", ";
                $vals .= ", ";
            }
        }

        return ["(" . $cols . ") VALUES(" . $vals . ")", $colvals];
    }
//INSERT INTO `sbf_database`.`users` (`id`, `email`, `password`, `salt`, `created`, `activated`)
// VALUES (NULL, 'blah@blah.blah', 'asdasf', 'erbver', UNIX_TIMESTAMP(), '0');

    private function parseInfo($arr, $second)
    {
        $ret = "";

        if ($second) {
            for ($i = 0; $i < count($arr); $i++) {
                $ret .= ":" . $arr[$i] . "";
                if ($i < count($arr) - 1)
                    $ret .= ", ";
            }

        } else {
            $ret .= "(";
            for ($i = 0; $i < count($arr); $i++) {
                $ret .= "`" . $arr[$i] . "`";
                if ($i < count($arr) - 1)
                    $ret .= ", ";
            }

            $ret .= ") VALUES (" . $this->parseInfo($arr, true) . ")";
        }

        return $ret;
    }
}