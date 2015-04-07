<?php
class UserModel
{
    private $id;

    private function __construct($id)
    {
        echo "setID: " . $id . "\n";
        self::checkUserID($id);

        $this->id = $id;
    }

    public static function Login($email, $pass)
    {
        // do error checking here

        $select = new SelectQuery();
        $select->Select("id")->Table("users")->Where("email", "=", $email, "and")->Where("password", "=", $pass)->Limit(1);
        $res = DatabaseManager::Query($select);
        if ($res->RowCount() == 1)
            return new UserModel($res->Result()['id']);

        return false;
    }

    public static function Register($email, $pass, $salt)
    {
        $insert = new InsertQuery();
        $insert->Table("users")->Set("email", $email)->Set("password", $pass)->Set("salt", $salt)->Set("created", "UNIX_TIMESTAMP()");
        $qinfo = DatabaseManager::Query($insert);
        //echo $qinfo->Errors();
        if ($qinfo->RowCount() == 1)
            return true;

        return false;
    }

    public static function Exists($column, $value)
    {
        $select = new SelectQuery();
        $select->Select('id')->Table("users")->Where($column, "=", $value)->Limit(1);
        $res = DatabaseManager::Query($select);
        if ($res->RowCount() == 1)
            return true;

        return false;
    }

    private static function checkUserID($id)
    {
        echo "User ID is: " . $id;
        if (!is_numeric($id))
            throw new Exception("User ID must be a number");
    }
}