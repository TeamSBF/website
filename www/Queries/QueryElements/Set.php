<?php
/*
 * An abstract class for the Set part of the query
 */
abstract class Set
{
    /*
     * The sets to be put into the query
     */
    protected $sets;
    
    protected $columns;

    /*
     * The class constructor
     */
    public function __construct()
    {
        $this->sets = [];
        $this->columns = [];
    }

    /*
     * Add the given array to the sets to be later parsed
     *
     * @param array $arr The list of column-value pairs to add
     */
    public function Set($arr)
    {
        foreach($arr as $element) {
            $column = $element[0];
            $value = $element[1];
            
            // if the column does not exist, add it it in and set it the count to zero
            if(!array_key_exists($column, $this->columns))
                $this->columns[$column] = 0;
            
            $boundColumn = $column.$this->columns[$column];
            
            $this->sets[] = new CVPair($column, $boundColumn, $value);
            
            $this->columns[$column]++;
        }
    }

    /*
     * Returns a MySQL formatted string that represents the Set data to be added to the query
     *
     * @param boolean $values A boolean that determines if the actual values are displayed or not
     * @return array An array that contains the query and the Column-Value pairs that the DatabaseManager needs
     */
    public function Query($values = false)
    {
        $ret = $this->format($values);
        $query = $ret[0];
        if($values)
            return $query;

        return [$query, $ret[1]];
    }

    /*
     * Parse the value given
     *
     * @param boolean $values A boolean that determines if the actual values are displayed or not
     * @param string $column The column to display if $values is false
     * @param string $value The value to display if $values is true
     * $return array An array that is used to determine if the CV pair needs to be sent to the database or not
     *               and the value to be displayed
     */
    protected static function parseValue($values, $column, $value)
    {
        $val = "";
        if ($values) {
            if (is_numeric($value))
                $val = $value;
            else
                $val = "'" . $value . "'";
        } else
            $val = ":" . $column;

        // If the value contains a built in MySQL function, override the return type and force
        // the original value to be used along with not being added to the CV pairs
        if (strpos($value, "()"))
            return [false, $value];

        // Tell the calling function that this column-value pair needs to be sent to the database
        // along with the value to send with it.
        return [true, $val];
    }

    /*
     * An abstract method that Query uses to get the parsed Set values
     *
     * @param boolean $values A boolean that determines if the actual values are displayed or not
     */
    protected abstract function format($values);
}