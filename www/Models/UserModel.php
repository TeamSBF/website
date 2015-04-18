<?php
/*
 * A class to represent the User
 */
class UserModel
{
    /*
     * The user ID of the user
     *
     * @var int
     */
    private $id;

    /*
     * The class constructor
     *
     * @param int $id The id of the user
     */
    private function __construct($id)
    {
        echo "setID: " . $id . "\n";
        self::checkUserID($id);

        $this->id = $id;
    }

    /*
     * Attempts to log the user in
     *
     * @param string $email The user's email address
     * @param string $pass The user's password
     *
     * @return mixed Returns the user's ID upon successful login or false upon failure
     */
    public static function Login($email, $pass)
    {
        // require the password file due to this being a php5.5 feature while using php5.4
        require_once("assets/password.php");

        // Gets a select query from the query factory
        $select = QueryFactory::Build("select");
        // Builds the select query
        $select->Select("id", "password")->From("users")->Where(["email", "=", $email])->Limit(1);
        // Get the results from the query exection
        $res = DatabaseManager::Query($select);
        // If a user was found, try to log them in
        if ($res->RowCount() == 1) {
            // Get the query results
            $resultArray = $res->Result();
            // If their provided password matches the database password, return the user ID
            if (password_verify($pass, $resultArray['password'])) {
                return $resultArray['id'];
            }
        }

        return false;
    }

    /*
     * Attempts to register a user
     *
     * @param string $email The users email
     * @param string $pass The users password
     *
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

    /*
     * Checks to see if a user exists with a specified column and value (recommended primarily or unique column)
     *
     * @param string $column The column to grab
     * @param string $value The value to compare the column against
     *
     * @return boolean True if the user exists, false if it doesn't
     */
    public static function Exists($column, $value)
    {
        // Get a select query
        $select = QueryFactory::Build("select");//new SelectQuery();
        // Build the select query
        $select->Select('id')->Table("users")->Where([$column, "=", $value])->Limit();
        // Execute the query and get the results
        $res = DatabaseManager::Query($select);
        // If the user exists, return true
        if ($res->RowCount() == 1)
            return true;

        return false;
    }

    /*
     * Checks the user ID to make sure it's numeric. Throws and error if it isn't.
     */
    private static function checkUserID($id)
    {
        echo "User ID is: " . $id;
        if (!is_numeric($id))
            throw new Exception("User ID must be a number");
    }

	/*
     * Update the password of the currently logged in user
     *
     * @param string $id The current  session id
     * @param string $newPass The new password that will be update
     *
     * @return boolean True if the change is a success, false if it doesn't
     */
	public static function updatePassword($id, $newPass)
	{
		$newPass = self::hashPass($newPass); // hash the incoming password
		$update = QueryFactory::Build("update"); //new update query
		$update->Table("users")->Where( ["id", "=", $id] )->Set(["password",  $newPass]); //update the query
		$res = DatabaseManager::Query($update); // execute the query
		
		if ($res->RowCount() == 1)
            return true;

        return false;
	}
    /*
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