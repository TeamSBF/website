<?php
/*
 * Provides the same functionality as Set except that it formats the values for an Insert query
 */
class InsertSet extends Set
{
    /*
     * Overridden from Set.php
     *
     * @param boolean $values Determines if it shows the values or the prepared statement
     *
     * @return array An array that contains the query string in the first element and any
     *               Column-Value pairs as the second element
     */
    protected function format($values = false)
    {
        $query = "";
        $cvs = [];

        $count = count($this->sets);
        // Start the columns string formatting
        $cols = "(";
        // Start the values string formatting
        $vals = "VALUES(";
        for ($i = 0; $i < $count; $i++) {
            // Get the set out of the sets
            $set = $this->sets[$i];
            // Add the column name to the column string
            $cols .= "`" . $set->Column() . "`";
            // Parse the value. This is used because we don't know if the value should be a value, column,
            // or static statement (ie UNIX_TIMESTAMP()).
            $ret = self::parseValue($values, $set->Column(), $set->Value());
            // The first element in the array will be the value to be added
            $vals .= $ret[1];

            // The second element determines if the column has an associated value that the DatabaseManager
            // will need or not
            if ($ret[0])
                $cvs[count($cvs)] = new CVPair($set->Column(), $set->Value());

            // Append as needed to keep it as a CSV
            if ($i < $count - 1) {
                $cols .= ", ";
                $vals .= ", ";
            }
        }
        // End the columns and values formatting
        $cols .= ")";
        $vals .= ")";
        // "build" the query
        $query = $cols . " " . $vals;

        // Return the query along with the cvs's as needed
        return [$query, $cvs];
    }
}