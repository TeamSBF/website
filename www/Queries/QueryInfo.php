<?php
class QueryInfo
{
    private $statement = null;

    public function __construct($stmt)
    {
        if($stmt instanceof PDOStatement)
            $this->statement = $stmt;
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
}