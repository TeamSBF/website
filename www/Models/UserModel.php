<?php
/**
 * Class UserModel A class to represent the User
 */
class UserModel
{
    /**
     * The user ID of the user
     * @var int
     */
    private $id;
    /**
     * The privilege level of the user
     * @var int
     */
    private $level;

    /**
     * The class constructor
     *
     * @param $info The array of info the model will store
     */
    private function __construct($info)
    {
        $this->id = $info['id'];
        $this->level = $info['pLevel'];
    }

    /**
     * @param $level The level to compare the user's level against
     * @return bool True if high enough, false if not
     * @throws Exception Thrown if $level is not an integer
     */
    public function HasPrivilege($level)
    {
        if(!is_int($level))
            throw new Exception("Privilege level('$level') must be an integer");

        return $this->level >= $level;
    }

    // ----------------------------- Static Functions -----------------------------
    /**
     * Attempts to log the user in
     *
     * @param string $email The user's email address
     * @param string $pass The user's password
     * @return mixed Returns the user's ID upon successful login or false upon failure
     */
    public static function Login($email, $pass)
    {
        // require the password file due to this being a php5.5 feature while using php5.4
        require_once("assets/password.php");

        // Gets a select query from the query factory
        $select = QueryFactory::Build("select");
        // Builds the select query
        $select->Select("id", "password", "pLevel")->From("users")->Where(["email", "=", $email])->Limit();
        // Get the results from the query execution
        $res = DatabaseManager::Query($select);
        // If a user was found, try to log them in
        if ($res->RowCount() == 1) {
            // Get the query results
            $resultArray = $res->Result();
            // If their provided password matches the database password, return a new user model
            if (password_verify($pass, $resultArray['password'])) {
                unset($resultArray['password']);
                return new UserModel($resultArray);
            }
        }

        return false;
    }

    /**
     * Attempts to register a user
     *
     * @param string $email The users email
     * @param string $pass The users password
     * @return boolean True when the registration succeeds and false when it fails
     */
    public static function Register($email, $pass)
    {
        // get the hashed passsword
        $pass = self::hashPass($pass);
        // Get an insert query
        $insert = QueryFactory::Build("insert");
        // Build the insert query
        $insert->Into("users")->Set(["email", $email], ["password", $pass], ["created", "UNIX_TIMESTAMP()"]);
        // Execute the query and get the result
        $qinfo = DatabaseManager::Query($insert);
        // If the user was added successfully return true
        if ($qinfo->RowCount() == 1)
            return true;

        return false;
    }

    /**
     * Checks to see if a user exists with a specified column and value (recommended primarily or unique column)
     *
     * @param string $column The column to grab
     * @param string $value The value to compare the column against
     * @return boolean True if the user exists, false if it doesn't
     */
    public static function Exists($column, $value)
    {
        // Get a select query
        $select = QueryFactory::Builder("select");//new SelectQuery();
        // Build the select query
        $select->Select('id')->Table("users")->Where([$column, "=", $value])->Limit();
        // Execute the query and get the results
        $res = DatabaseManager::Query($select);
        // If the user exists, return true
        if ($res->RowCount() == 1)
            return true;

        return false;
    }

    /**
     * Hashes a given password
     *
     * @param string $pass The password to be hashed
     * @return string The hashed password
     */
    private static function hashPass($pass)
    {
        require_once("assets/password.php");
        $options = array('cost' => 11);
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
}