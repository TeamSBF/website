<?php
/*
 * Provides an object wrapper for the PDOStatement object that is used to retrieve the database results
 */
class QueryInfo
{
    /*
     * A reference to the PDOStatement
     *
     * @var PDOStatement
     */
    private $statement = null;
    /*
     * A string that contains the error.
     *
     * @var string
     */
    private $errors = "No Errors";

    /*
     * The class constructor
     *
     * @param PDOStatement The PDOStatement to be stored
     * @param string Any error(s) that occurred during the execution of the query
     */
    public function __construct($stmt, $errors)
    {
        if($stmt instanceof PDOStatement)
            $this->statement = $stmt;

        if($errors != "")
            $this->errors = $errors;
    }

    public function RowCount()
    {
        return $this->statement->rowCount();
    }

    public function ColumnCount()
    {
        return $this->statement->columnCount();
    }

    public function Result()
    {
        if ($this->RowCount() > 1)
            return $this->statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function ErrorCode()
    {
        return $this->statement->errorCode();
    }

    public function ErrorInfo()
    {
        return $this->statement->errorInfo();
    }

    public function Errors()
    {
        return $this->errors;
    }
}