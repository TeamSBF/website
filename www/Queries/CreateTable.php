<?php
/*
 * THIS NEEDS TO BE REFACTORED TO UTILIZE THE QUERY OBJECT TO SIMPLIFY THE OVERALL STRUCTURE
 */

/**
 * Class CreateTable
 */
class CreateTable
{
    /**
     * @var string
     */
    private $name = "";
    /**
     * @var string
     */
    private $ai = "";
    /**
     * @var array
     */
    private $cols = [];
    /**
     * @var array
     */
    private $keys = [];

    /**
     * @param $tableName
     */
    public function __construct($tableName)
    {
        $this->name = $tableName;
    }

    /**
     * @param $colName
     * @param null $type
     * @param null $value
     * @return $this
     * @throws Exception
     */
    public function AddColumn($colName, $type = null, $value = null)
    {
        if ($this->columnNameExists($colName))
            throw new Exception("Column name '$colName' already exists in table '" . $this->name . "'");

        $this->cols[count($this->cols)] = ['name' => $colName, 'type' => $type, 'value' => $value];

        return $this;
    }

    /**
     * @param $type
     * @param null $value
     * @param null $colName
     * @return $this
     * @throws Exception
     */
    public function AddAttribute($type, $value = null, $colName = null)
    {
        $colID = $this->getColumnID($colName);
        if ($value == null)
            $value = $this->getDefaultValue($type);

        $type = $this->translateType($type);

        if ($colID < 0) {
            $err = "Error occurred while trying to add attributes to column '$colName' in table '$this->name'";
            if ($colID == -1)
                $err = "There are no columns in table '$this->name' to add these attributes to";

            throw new Exception($err);
        }

        $this->cols[$colID]['type'] = $type;
        $this->cols[$colID]['value'] = $value;

        return $this;
    }

    /**
     * @param null $value
     * @param null $colname
     * @return $this
     */
    public function MakeInt($value = null, $colname = null)
    {
        $this->AddAttribute('int', $value, $colname);
        return $this;
    }

    /**
     * @param null $value
     * @param null $colName
     * @return $this
     */
    public function MakeBool($value = null, $colName = null)
    {
        $this->AddAttribute('bool', $value, $colName);
        return $this;
    }

    /**
     * @param null $value
     * @param null $colName
     * @return $this
     */
    public function MakeVarChar($value = null, $colName = null)
    {
        $this->AddAttribute('varchar', $value, $colName);
        return $this;
    }

    public function MakeFloat($value = null, $colName = null)
    {
        $this->AddAttribute('float', $value, $colName);
        return $this;
    }

    public function MakeText($value = null, $colName = null)
    {
        $this->AddAttribute('text', $value, $colName);
        return $this;
    }

    public function MakeTinyInt($value = null, $colName = null)
    {
        $this->AddAttribute('tinyint', $value, $colName);
        return $this;
    }

    /**
     * @param null $colName
     * @return $this
     * @throws Exception
     */
    public function SetAutoIncrement($colName = null)
    {
        $colName = $this->getColumnName($colName);

        if (!$this->columnNameExists($colName))
            throw new Exception("Column '$colName' does not exist in table '$this->name'");

        $this->ai = $colName;
        $this->keys['primary'] = $colName;
        $this->AddKey('primary', $colName);
        $this->AddAttribute('int', '11', $colName);

        return $this;
    }

    /**
     * @param $value
     * @param null $colName
     * @return $this
     */
    public function DefaultValue($value, $colName = null)
    {
        $colName = $this->getColumnName($colName);
        $colID = $this->getColumnID($colName);

        $this->cols[$colID]['default'] = $value;

        return $this;
    }

    /**
     * @param $keyType
     * @param null $colName
     * @return $this
     * @throws Exception
     */
    public function AddKey($keyType, $colName = null)
    {
        $keyType = strtolower($keyType);
        $colName = $this->getColumnName($colName);
        //if($type == "primary" && array_key_exists($type, $this->keys))
        //    throw new Exception("The key type '$type' already exists in table '$this->name");

        // if the column name does not exist it cannot be added as a key
        if (!$this->columnNameExists($colName))
            throw new Exception("Could not find column '$colName' in table '$this->name' to add as a key");

        if ($keyType === "primary")
            $this->keys[$keyType] = $colName;
        else {
            // if the key does not exist, create it
            if (!array_key_exists($keyType, $this->keys))
                $this->keys[$keyType] = [];

            // check to see if the column has already been added to the key list
            // if it does, simply return.
            foreach ($this->keys[$keyType] as $key)
                if ($key == $colName)
                    return $this;

            // add the key to the end of the array
            $this->keys[$keyType][count($this->keys[$keyType])] = $colName;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function Columns()
    {
        return $this->cols;
    }

    /**
     * @return array
     */
    public function Keys()
    {
        return array_merge($this->keys, ["ai" => $this->ai]);
    }

    /**
     * @param $type
     * @return int|null
     */
    private function getDefaultValue($type)
    {
        $default = null;
        switch ($type) {
            case "varchar":
                $default = 50;
                break;
            case "tinyint":
                $default = 3;
                break;
            case "bool":
            case "boolean":
                $default = 1;
                break;
            case "text":
                $default = "";
                break;
            case "tinyint":
                $default = 4;
                break;
            case "int":
            default:
                $default = 11;
                break;
        }

        return $default;
    }

    /**
     * @param $type
     * @return int|string
     */
    private function translateType($type)
    {
        switch (strtolower($type)) {
            case "bool":
                $type = "tinyint";
                break;
            case "false":
                $type = 0;
                break;
            case "true":
                $type = 1;
                break;
        }

        return $type;
    }

    /**
     * @param null $colName
     * @return null
     * @throws Exception
     */
    private function getColumnName($colName = null)
    {
        // if the column name was left out, grab the previously added column if possible.
        // otherwise throw an error.
        if ($colName == null)
            if (count($this->cols) > 0)
                $colName = $this->cols[count($this->cols) - 1]['name'];
            else
                throw new Exception("There are no columns in table '$this->name' to add these attributes to");

        return $colName;
    }

    /**
     * @param $colName
     * @return int
     */
    private function getColumnID($colName)
    {
        $colName = $this->getColumnName($colName);

        for ($i = 0; $i < count($this->cols); $i++)
            if ($this->cols[$i]['name'] === $colName)
                return $i;

        // if the column was not found
        return -1;
    }

    /**
     * @param $colName
     * @return bool
     */
    private function columnNameExists($colName)
    {
        foreach ($this->cols as $col)
            if ($col['name'] === $colName)
                return true;

        return false;
    }

    /**
     * @param bool $includeAlter
     * @return string
     */
    public function Query($includeAlter = true)
    {
        // "if not exists" is used to prevent any accidental overwriting of data
        $query = "CREATE TABLE IF NOT EXISTS `$this->name` (\n";
        for ($i = 0; $i < count($this->cols); $i++) {
            $col = $this->cols[$i];
            $query .= $this->createSQLAttribute($col);

            // if the field has a default value
            if (isset($col['default']))
                $query .= " DEFAULT '" . $this->translateType($col['default']) . "'";

            // it must be a csv list
            if ($i < count($this->cols) - 1)
                $query .= ",";

            // readability formatting, not really required
            $query .= "\n";
        }
        $query .= ");\n";

        if ($includeAlter)
            $query .= $this->AlterTable();

        return $query;
    }

    /**
     * @return string
     */
    public function AlterTable()
    {
        $query = "";
        if (count($this->keys) > 0) {
            $query .= "ALTER TABLE `$this->name` ";
            $keys = array_keys($this->keys);
            for ($i = 0; $i < count($keys); $i++) {
                $key = $keys[$i];
                if ($key == "primary") {
                    $col = $this->keys[$key];
                    $query .= "ADD " . strtoupper($key) . " KEY (`$col`)";
                } else {
                    $moreKeys = $this->keys[$key];
                    for ($j = 0; $j < count($moreKeys); $j++) {
                        $subkey = $moreKeys[$j];
                        $query .= "ADD " . strtoupper($key) . " KEY `$subkey` (`$subkey`)";

                        if ($j < count($moreKeys) - 1)
                            $query .= ", ";
                    }
                }

                if ($i < count($keys) - 1)
                    $query .= ", ";
            }
        }

        // add the auto-increment field
        $query .= $this->addAutoIncrement();

        return $query . ";";
    }

    /**
     * @return string|void
     */
    private function addAutoIncrement()
    {
        if ($this->ai === "") return;

        $colID = $this->getColumnID($this->ai);
        $col = $this->cols[$colID];
        return ", MODIFY " . $this->createSQLAttribute($col) . " AUTO_INCREMENT";
    }

    /**
     * @param $col
     * @return string
     */
    private function createSQLAttribute($col)
    {
        $name = $col['name'];
        $type = $col['type'];
        $value = "";
        if(!empty($col['value']))
            $value = "(" . $col['value'] . ")";
        return "`$name` " . strtoupper($type) . "$value NOT NULL";
    }
}