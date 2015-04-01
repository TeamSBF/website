<?php
/*
  "CREATE TABLE `users` (" .
  "`id` int(11) NOT NULL," .
  "`email` varchar(100) NOT NULL," .
  "`password` varchar(100) NOT NULL," .
  "`created` int(11) NOT NULL," .
  "`activated` tinyint(1) NOT NULL DEFAULT '0'" .
  ") ENGINE=InnoDB DEFAULT CHARSET=utf8;" .
  "ALTER TABLE `users`" .
  "ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);";
 */
class TableQuery
{
    private $name = "";
    private $cols = [];
    private $keys = [];

    public function __construct($tableName)
    {
        $this->name = $tableName;
    }

    public function AddColumn($colName, $type = null, $value = null)
    {
        if(array_key_exists($colName, $this->cols))
            throw new Exception("Column name '$colName' already exists in table '" . $this->name . "'");

        $this->cols[count($this->cols)] = ['name' => $colName, 'type' => $type, 'value' => $value];

        return $this;
    }

    public function AddAttribute($type, $value, $colName = null)
    {
        $colID = $this->getColumnID($colName);

        $this->cols[$colID]['type'] = $type;
        $this->cols[$colID]['value'] = $value;

        return $this;
    }

    public function DefaultAttribute($value, $colName = null)
    {
        $colID = $this->getColumnID($colName);

        $this->cols[$colID]['default'] = $value;
    }

    public  function AddKey($key, $type)
    {
        if($type == "primary" && array_key_exists($type, $this->keys))
            throw new Exception("The key type '$type' already exists in table '$this->name");



    }

    private function getColumnID($colName)
    {
        // if the column name was left out, grab the previously added column if possible.
        // otherwise throw an error.
        if($colName == null)
            if(count($this->cols) > 0)
                $colName = $this->cols[count($this->cols) - 1]['name'];
            else
                throw new Exception("There are no columns in table '$this->name' to add these attributes to");

        $colID = -1;
        for($i = 0; $i < count($this->cols); $i++)
        {
            if($this->cols[$i]['name'] === $colName)
            {
                $colID = $i;
                break;
            }
        }
        // if the column was not found
        if($colID == -1)
            throw new Exception("The column name '$colName' does not exist in table '$this->name'");

        return $colID;
    }

    public function Query()
    {
        $query = "CREATE TABLE IF NOT EXISTS `" . $this->name . "` (";

        $keys = array_keys($this->cols);
        foreach($keys as $key)
        {
            $col = $this->cols[$key];
            $query .= "``" . $key . "`" . $col['type'] . '(' . $col['value'] . ')';
        }

        return $query;
    }
}