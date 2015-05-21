<?php
/*
 * A class for the Where part of the query
 */
class Where
{
    /*
     * An array of where statements
     *
     * @var array
     */
    private $where;
    
    private $columns;

    public function __construct()
    {
        $this->where = [];
        $this->columns = [];
    }

    /*
     * Takes an array of CVOC values and stores them into a CVOC object
     *
     * @param array $arr The elements to store for query parsing
     * @param boolean $clear Used to either append the given $arr or store only the $arr
     */
    public function Where($arr, $clear = false)
    {
        // If clean, delete the array
        if($clear)
            $this->where = [];

        foreach($arr as $where)
        {
            // If there are less than 4 values given, set the 4th to be empty
            // This will happen if a condition is not given, specifically at the end of the elements
            if(count($where) < 4)
                $where[3] = "";
                
            // translate the where attributes coming in to more readable forms
            $column = $where[0];
            $operator = $where[1];
            $value = $where[2];
            $condition = $where[3];
            
            // if the column does not exist, add it it in and set it the count to zero
            if(!array_key_exists($column, $this->columns))
                $this->columns[$column] = 0;
                
            // set the bound column to guarantee a unique identifier
            $boundColumn = $column.$this->columns[$column];
            
            // Store the values in a CVOCPair object
            $this->where[] = new CVOCPair($column, $boundColumn, $value, $operator, $condition);
            
            // increment the column count to guarantee unique bindings
            $this->columns[$column]++;
        }
        //printr($this->columns);
    }

    /*
     * Returns a MySQL formatting string for the where part of the query
     *
     * @param boolean $values A boolean that determines if the actual values are displayed or not
     * @return array An array that contains the query string in the first element and any
     *               Column-Value pairs as the second element
     */
    public function Query($values = false)
    {
        $count = count($this->where);
        if($count < 1)
            return "";

        $query = "WHERE ";
        for ($i = 0; $i < $count; $i++) {
            $where = $this->where[$i];

            $query .= "`" . $where->Column() . "` " . $where->Operator();
            $query .= " " . ((!$values) ? ":" . $where->BoundColumn() : "'".$where->Value()."'");

            if (!self::isEmpty($where->Condition())) {
                $query .= " " . $where->Condition();
            }
            if ($i < $count - 1)
                $query .= " ";
        }

        if($values)
            return $query;

        return [$query, $this->where];
    }

    private static function isEmpty($element)
    {
        return (!isset($element) || trim($element)==='');
    }
}