<?php
class Limit
{
    private $limit;
    private $set;

    public function __construct($limit = null)
    {
        $this->set = false;
        $this->limit = 0;

        $this->setLimit($limit);
    }

    public function Limit($limit = null)
    {
        if ($limit == null)
            $limit = 1;

        if (is_array($limit))
            $limit = $limit[0];

        if (is_int($limit))
            $this->setLimit($limit);
    }

    public function Query()
    {
        if ($this->set)
            return "LIMIT " . $this->limit;
    }

    private function setLimit($limit)
    {
        if ($limit != null) {
            $this->set = true;
            $this->limit = $limit;
        }
    }
}