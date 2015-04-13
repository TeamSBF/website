<?php
/*
 * The primary query object used to communicate with the database
 */
class Query implements IQuery
{
    // ---
    /*
     * An array that contains function call names that need to be translated
     *
     * @var array
     */
    private static $translatedNames = ["from"=>"Table", "into"=>"Table"];
    // ---

    /*
     * The pieces that make up the query. This restricts the usage of which functions can and cannot be called.
     * This is stored in the format of [method name => object]
     *
     * @var array
     */
    private $pieces;

    /*
     * Class constructor.
     *
     * @param array $pieces The parts that make up the query. This comes from the QueryFactory
     */
    public function __construct($pieces)
    {
        // Initialize the class's pieces array.
        $this->pieces = [];

        // Store each piece into the object making sure to translate as needed.
        foreach ($pieces as $piece) {
            // Since set has 2 classes that extend it, we must differentiate and grab the
            // parent of the set type while grabbing the class of those who are not
            $name = (!is_subclass_of($piece, "Set")) ? get_class($piece) : get_parent_class($piece);
            // Store the piece into an associative array in a [method name => object] fashion.
            $this->pieces[strtolower($name)] = $piece;
        }
    }

    /*
     * The entry point for ALL method calls against the object. This is used since the object's "capabilities"
     * are stored in the pieces array above, therefore there is no way to know what the current object has
     *
     * @param string $func The function/method being called
     * @param array $params An array of parameters that were passed to $func when called
     * @return mixed Returns a string from a parameter-less call or the query instance
     */
    public function __call($func, $params)
    {
        $ret = "";
        // Set the $func to lower case to make it less of a nightmare in trying to find
        $obj = strtolower($func);
        // Check to see if the calling function needs to be translated
        // This generally only applies to table but can be extrapolated onto anything else
        if (array_key_exists($obj, self::$translatedNames)) {
            // Get the translated name and override what $func is currently set to
            $func = self::$translatedNames[$obj];
            // Override the current object reference and update it to the translated one
            $obj = strtolower($func);
        }

        // Check to see if the called query has the requested function/method
        if (array_key_exists($obj, $this->pieces)) {
            // The line looks psychotic but it's literally only calling the object's associated method and
            // passing the parameters to it.
            // EX: $select->Select(...) will call the Select object's Select method and pass it ... as an array.
            $ret = $this->pieces[$obj]->$func($params);

            // Method calls have the option of returning their associated stored value when not given any
            // parameters. This checks for that and returns that instead of the object instance. This DOES
            // break method chaining but it is assumed that when no parameters are passed, the caller doesn't
            // want to chain methods together and is after information instead.
            if(!empty($params))
                $ret = $this;
        }else
            // throw an error if the given method call wasn't or couldn't be found.
            throw new Exception("Method name('$func') does not exist.");

        // return either the return value from the parameter-less method call or the current query instance.
        return $ret;
    }

    /*
     * Returns the text version of the query
     *
     * @param boolean $values A boolean that determines if the returned text query will display the prepared
     *                        statement query or a value-filled query. This option is entirely for display/debug
     *                        purposes only as the DatabaseManager does not utilize this option.
     * @return string A string that represents the query
     */
    public function Query($values = false)
    {
        $query = "";
        // The column value pairs to send with the prepared statement query to guarantee column-value
        // correlation when binding values in the DatabaseManager
        $cvs = [];

        // Iterate through each piece of the query
        foreach ($this->pieces as $piece) {
            // Call the piece's Query method, giving it the $values parameter
            $q = $piece->Query($values);
            // Check to see if the returned query is an array.
            // This is the current fix to those queries that need to return their column-value associated pairs
            if (!is_array($q)) { // The most likely case when the returned value is NOT an array
                // Concatenate the returned string onto the query string that will be returned
                $query .= " " . $q;
            } else { // The less likely case when the returned value IS an array
                // Concatenate the first element in the returned array, which is assumed to
                // be the query itself
                $query .= " " . $q[0];
                // Merge the returned column-value pairs with the current column-value pairs
                $cvs = array_merge($q[1], $cvs);
            }

        }

        // Return the query string with the column-value pairs in an array
        return [$query, $cvs];
    }
}