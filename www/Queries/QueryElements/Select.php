<?php
/*
 * A class for the Select query
 */
class Select
{
    /*
     * The fields to be selected
     *
     * @var array
     */
    private $select;

    /*
     * The class constructor
     */
    public function __construct()
    {
        $this->select = [];
    }

    /*
     * Takes an array and stores it for parsing
     *
     * @param array $arr
     */
    public function Select($arr)
    {
        // Checks to see if the parameter is an array
        if (is_array($arr))
            $this->select = $arr;
    }

    /*
     * Returns a string of the query in MySQL format
     *
     * @return string The MySQL formatted string of the query
     */
    public function Query()
    {
        $query = "SELECT ";
        $count = count($this->select);
        for($i = 0; $i < $count; $i++)
        {
            $query .= "`" . $this->select[$i] . "`";
            if($i < $count - 1)
                $query .= ", ";
        }

        return $query . " FROM";
    }
}