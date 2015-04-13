<?php
/*
 * A class that stores the queries target table
 */
class Table
{
    /*
     * The target table
     *
     * @var string
     */
    private $table;

    /*
     * The class constructor
     *
     * @param string $name The name of the table to target for the query
     */
    public function __construct($name = null)
    {
        $this->table = $name;
    }

    /*
     * Gets or sets the name of the table. If the name is not specified, the current target is returned.
     *
     * @param string $name The name of the table to target
     */
    public function Table($name = null)
    {
        if($name == null)
            return $this->table;

        if (is_array($name))
            $name = $name[0];

        $this->table = $name;
    }

    /*
     * Returns a MySQL formatted table string
     */
    public function Query()
    {
        return "`" . $this->table . "`";
    }
}