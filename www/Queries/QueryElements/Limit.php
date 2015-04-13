<?php
/*
 * A class to define the limit for a query
 */
class Limit
{
    /*
     * The limit to impose on the query
     *
     * @var int
     */
    private $limit;
    /*
     * A variable determining if the limit has been set or not
     *
     * @var boolean
     */
    private $set;

    /*
     * The class constructor
     *
     * @param int $limit (Optional) The query row return limit. Can be set later.
     */
    public function __construct($limit = null)
    {
        $this->set = false;
        $this->limit = 0;

        $this->setLimit($limit);
    }

    /*
     * Sets the limit
     */
    public function Limit($limit = null)
    {
        if ($limit == null)
            $limit = 1;

        // This is here because of how the Query __call method handles parameters
        if (is_array($limit))
            $limit = $limit[0];

        // Final check to make sure the given limit is indeed an integer
        if (is_int($limit))
            $this->setLimit($limit);
    }

    /*
     * Returns the MySQL formatted string for the limit
     */
    public function Query()
    {
        if ($this->set)
            return "LIMIT " . $this->limit;
    }

    /*
     * Private method used to toggle whether the limit is displayed or not
     */
    private function setLimit($limit)
    {
        if ($limit != null) {
            $this->set = true;
            $this->limit = $limit;
        }
    }
}