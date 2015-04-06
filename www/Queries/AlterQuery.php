<?php
class AlterQuery extends AbstractQuery
{
    private $fields = [];
    private $keys = [];
    private $ai = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function AddField($name, $type, $value = null)
    {
        $this->fields[count($this->fields)] = new FieldElement($name, $type, $value);
    }

    public function AddKey($type, $name = null)
    {
        $name = $this->getFieldName($name);
        $type = strtolower($type);
        if ($type == "primary")
            $this->keys[$type] = $name;
        else {
            if (!array_key_exists($type, $this->keys))
                $this->keys[$type] = [];
            $this->keys[$type][count($this->keys[$type])] = $name;
        }
    }

    public function SetAutoIncrement($name = null)
    {
        $name = $this->getFieldName($name);
        $this->ai = $name;
        $this->keys["primary"] = $name;
    }

    public function Fields()
    {
        return $this->fields;
    }

    public function Keys()
    {
        return $this->keys;
    }

    public function Query()
    {
        $query = "ALTER TABLE `" . $this->table . "`\n";
        $query .= $this->parseFields();
        $query .= $this->parseKeys();

        return [$query, []];
    }

    private function parseFields()
    {
        $fields = $this->fields;
        $ret = "";
        for($i = 0; $i < count($fields); $i++)
        {
            $name = $fields[$i]->Name();
            $type = $fields[$i]->Type();
            $value = $fields[$i]->Value();
            $value = ($value == null) ? $this->getDefaultValue($type) : $value;

            $ret .= " ADD `" . $name . "` ";
            $ret .= strtoupper($type) . "(". $value .") NOT NULL";
            if($this->ai == $name)
                $ret .= " AUTO_INCREMENT";

            if($i < count($fields) - 1)
                $ret .= ",";

            $ret .= "\n";
        }

        return $ret;
    }

    private function parseKeys()
    {
        $ret = "";
        $keys = $this->keys;
        if (array_key_exists("primary", $keys))
            $ret .= ",\nADD PRIMARY KEY (`" . $keys["primary"] . "`)";
        if(array_key_exists("unique",$keys))
            for($i = 0; $i < count($keys["unique"]); $i++)
                $ret .= ", ADD UNIQUE (`" . $keys["unique"][$i] . "`)";

        return $ret;
    }

    //ALTER TABLE `users` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST,
    //                    ADD `email` VARCHAR(100) NOT NULL AFTER `id`,
    //                    ADD PRIMARY KEY (`id`) , ADD UNIQUE (`email`) ;

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
                $default = 0;
                break;
            case "int":
            default:
                $default = 11;
                break;
        }

        return $default;
    }

    private function getFieldName($name)
    {
        return ($name == null) ? $this->fields[count($this->fields) - 1]->Name() : $name;
    }
}

//ALTER TABLE `users` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`) ;
//ALTER TABLE `users` ADD `email` VARCHAR(100) NOT NULL , ADD UNIQUE `email` (`email`) ;
//ALTER TABLE `users` ADD `password` VARCHAR(50) NOT NULL AFTER `id`;