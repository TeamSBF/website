<?php
/*
 * Provides the same functionality as Set except that it formats the values for an Update query
 */
class UpdateSet extends Set
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
        $query = "SET ";
        $cvs = [];

        printr($values);
        $count = count($this->sets);
        for ($i = 0; $i < $count; $i++) {
            // Grab an individual set
            $set = $this->sets[$i];
            // Set the column for the query
            $query .= $set->Column() . " = ";
            // Parse the value. This is used because we don't know if the value should be a value, column,
            // or static statement (ie UNIX_TIMESTAMP()).
            $ret = self::parseValue($values, $set->BoundColumn(), $set->Value());
            // The first element in the array will be the value to be added
            $query .= $ret[1];

            // The second element determines if the column has an associated value that the DatabaseManager
            // will need or not
            if ($ret[0])
                $cvs[] = $set;//new CVPair($set->Column(), $set->Value());

            // Append as needed to maintain a CSV list
            if ($i < $count - 1)
                $query .= ", ";
        }

        // Return the query along with the cvs's as needed
        return [$query, $cvs];
    }
}