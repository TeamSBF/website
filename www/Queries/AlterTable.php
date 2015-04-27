<?php
/**
 * The query that provides table altering support. This is, so far, solely used by the MigrationManager
 * when an error has occurred during the execution of a query to repair the tables' associated column(s)
 * THIS NEEDS TO BE REFACTORED TO UTILIZE THE QUERY OBJECT TO SIMPLIFY THE OVERALL STRUCTURE
 */
class AlterTable implements IQuery
{
    /**
     * The name of the table to be altered
     *
     * @var string
     */
    private $table;
    /**
     * The fields to be added or changed
     *
     * @var array
     */
    private $fields = [];
    /**
     * Any keys that might need to be added or changed
     *
     * @var array
     */
    private $keys = [];
    /**
     * The value that is to be set to auto-incremenet
     *
     * @var string
     */
    private $ai = "";

    /**
     * The class constructor
     */
    public function __construct()
    {
        $this->table = "";
    }

    /**
     * Defines the table to be altered
     *
     * @param string $tableName The name of the table name to be altered. The parameters is optional
     * @return mixed If the $tableName was not provided, the current table name is returned instead.
     *               Otherwise the alter table instance.
     */
    public function Table($tableName = null)
    {
        // If no table name was provided, return the table name
        if ($tableName == null)
            return $this->table;

        // If the provided table name is not a string, return nothing.
        // This is the equivalence of dieing silently.
        if (!is_string($tableName))
            return;

        // Set the current table name to the name given
        $this->table = $tableName;
        // Return the current instance to enable method chaining
        return $this;
    }

    /**
     * Adds a field
     *
     * @param $field
     */
    public function AddField($field)
    {
        if(!isset($field['default']))
            $field['default'] = null;
        // Store the field as a new field object
        $this->fields[count($this->fields)] = new Field($field['name'], $field['type'], $field['value'], $field['default']);
    }

    /**
     * Adds a key to the table given an optional field name.
     * Note when the name is left out, this method defaults to the previously added field to make as the key
     *
     * @param string $type The MySQL key type
     * @param string $name (Optional) The field name to define as a key
     *
     * @return AlterTable The current instance. This allows for method chaining.
     */
    public function AddKey($type, $name = null)
    {
        // Get the field name to be made a key.
        $name = $this->getFieldName($name);

        // To keep things simple and easy with guarantees, make it all lower case.
        $type = strtolower($type);

        // We only allow one primary key
        if ($type == "primary")
            $this->keys[$type] = $name;
        else {
            // If the key does not currently exist, create it
            if (!array_key_exists($type, $this->keys))
                $this->keys[$type] = [];
            // Add the given $name to the array of keys given the $type
            $this->keys[$type][count($this->keys[$type])] = $name;
        }

        return $this;
    }

    /**
     * Sets the given $name to be the auto-incremented field in the table. Note this overwrites the primary key.
     *
     * @param string $name (Optional) The name of the field (column) to be set to the auto-increment column and key
     * @return AlterTable Returns the current instance
     */
    public function SetAutoIncrement($name = null)
    {
        // Get the name of the field to be set to the AI value
        $name = $this->getFieldName($name);
        // Set the AI value to the name
        $this->ai = $name;
        // Set the primary key to be the given name
        $this->AddKey("primary", $name);

        return $this;
    }

    /**
     * Returns the current fields array
     */
    public function Fields()
    {
        return $this->fields;
    }

    /**
     * Returns the current keys array
     */
    public function Keys()
    {
        return $this->keys;
    }

    /**
     * Returns the string query that is used to execute the query
     *
     * @param boolean $values A boolean to print the values in the query. This is a superficial option and has
     *                        no affect on the scripts overall performance.
     * @return array The query and the column-value pairs (always guaranteed to be empty)
     *               needed by the DatabaseManager.
     */
    public function Query($values = null)
    {
        // Set the query to the start of the MySQL statement
        $query = "ALTER TABLE `" . $this->table . "`\n";
        // Append the parsed fields
        $query .= $this->parseFields();
        // Append the parsed keys
        $query .= $this->parseKeys();

        return [$query, []];
    }

    /**
     * Parses the fields into MySQL format
     *
     * @return string Returns the fields parsed into MySQL format
     */
    private function parseFields()
    {
        // Grab all the fields
        $fields = $this->fields;
        $ret = "";
        for ($i = 0; $i < count($fields); $i++) {
            // Grab the associated information for each field
            $name = $fields[$i]->Name();
            $type = $fields[$i]->Type();
            $value = $fields[$i]->Value();
            // Check to see if the column has a value associated with it. If it doesn't, grab a default one
            $value = ($value == null) ? $this->getDefaultValue($type) : $value;
            $default = $fields[$i]->DefaultValue();

            // Append the name to the query string
            $ret .= " ADD `" . $name . "` ";
            // Append the column type to the query string
            $ret .= strtoupper($type) . "(" . $value . ") NOT NULL";
            // Check for default values
            if ($default)
                $ret .= " DEFAULT '" . $default . "'";
            // Check for the auto-increment field and append if needed
            if ($this->ai == $name)
                $ret .= " AUTO_INCREMENT";

            // If we're not at the end, append a comma
            if ($i < count($fields) - 1)
                $ret .= ",";
            // This is for readability when printing to the screen to visually see it
            $ret .= "\n";
        }

        return $ret;
    }

    /**
     * Parses the keys associated with the table
     *
     * @return string Returns the keys parsed into MySQL format
     */
    private function parseKeys()
    {
        $ret = "";
        // Grab the keys for the table
        $keys = $this->keys;
        // Check to see if the primary key was set and append it if it has been
        if (array_key_exists("primary", $keys))
            $ret .= ",\nADD PRIMARY KEY (`" . $keys["primary"] . "`)";
        // Check to see if the unique key exists and append as needed
        if (array_key_exists("unique", $keys))
            for ($i = 0; $i < count($keys["unique"]); $i++)
                $ret .= ", ADD UNIQUE (`" . $keys["unique"][$i] . "`)";

        return $ret;
    }

    /**
     * Gets the default value (storage capacity in this context) for the given type
     *
     * @param string $type The type of field
     * @return int The default value associated with the given field $type
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
            case "int":
            default:
                $default = 11;
                break;
        }

        return $default;
    }

    /**
     * Returns either the $name of the previously added field's $name
     */
    private function getFieldName($name)
    {
        return ($name == null) ? $this->fields[count($this->fields) - 1]->Name() : $name;
    }
}