<?php
/*
 * A class to store a Column-Value association
 */
class CVPair
{
    /*
     * The column to be stored
     *
     * @var string
     */
    protected $column;
    /*
     * The value to be stored
     *
     * @var string
     */
    protected $value;
    
    protected $boundColumn;

    /*
     * The class constructor
     *
     * @param string $column The column to be stored
     * @param string $value The value to be stored
     */
    public function __construct($column, $boundColumn, $value)
    {
        $this->column = $column;
        $this->value = $value;
        $this->boundColumn = $boundColumn;
    }

    public function Column()
    {
        return $this->column;
    }

    public function Value()
    {
        return $this->value;
    }
    
    public function BoundColumn()
    {
        return $this->boundColumn;
    }
}