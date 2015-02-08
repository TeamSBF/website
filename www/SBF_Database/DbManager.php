<?php
/**
 * Created by PhpStorm.
 * Author: Sami Awwad
 * Date: 2/1/2015
 * Time: 2:48 PM
 *
 * instances of the DbManager should be used inside a controller class
 */

class DbManager
{
    private $servername = "localhost";
    private $username = "admin";
    private $password = "password";
    private $connection = null;

    function __construct()
    {
        // for testing purposes
        $this->testConnection();
    }

    // for testing purposes
    private function testConnection()
    {
        $this->connection = $this->connect();

        if ( $this->connection != null) {
            echo "Connection to sbf_database successful<br>\n";
        }
        $this->connection = null;
    }

    private function connect()
    {
        // create the connection to the database
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=sbf_database", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "<br>\n";
        }
        return null;
    }

    public function addUser($usr)
    {
        try {
            $this->connection = $this->connect();
            $stmt = $this->connection->prepare("INSERT INTO user (Email, LastName, FirstName, UserName, Gender, DOB)"
                . " VALUES (:email, :lastName, :firstName, :userName, :gender, :dob)");
            $stmt->execute(array(':email' => $usr->email,
                                 ':lastName' => $usr->lastName,
                                 ':firstName' => $usr->firstName,
                                 ':userName' => $usr->userName,
                                 ':gender' => $usr->gender,
                                 ':dob' => $usr->dob));
            echo "New User record added successfully<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
        $this->connection = null;
    }

    public function retrieveUserTable()
    {
        try {
            $this->connection = $this->connect();
            $sql = "SELECT * FROM user";
            $result = $this->connection->query($sql);

            // code below for testing
            if ($result)
            {
                while ($row = $result->fetch())
                {
                    print_r($row);
                }
            }
            echo "retrieved User table successfully<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . '<br>\n';
        }
        $this->connection = null;

    }

    public function deleteUser($email)
    {
        $id = $this->getUserID($email);

        try {
            $this->connection = $this->connect();
            $stmt = $this->connection->prepare("DELETE FROM user WHERE ID = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            print("Deleting User with ID: " . $id . "<br>\n");
            echo "Delete on cascade should have deleted corresponding user rows in other tables (do a manual check)<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
        $this->connection = null;
    }

    public function addAssessment($assess)
    {
        $userID = $this->getUserID($assess->email);
        try {
            $this->connection = $this->connect();
            $stmt = $this->connection->prepare("INSERT INTO assessment (UserID, FunctionalReach, BalanceTest, FootUp,"
                . " StepTest, ArmCurl, ChairStand, DateCreated)"
                . " VALUES (:userID, :ex1, :ex2, :ex3, :ex4, :ex5, :ex6, :dateC)");
            $stmt->execute(array(':userID' => $userID,
                ':ex1' => $assess->functionalReach,
                ':ex2' => $assess->balanceTest,
                ':ex3' => $assess->footUp,
                ':ex4' => $assess->stepTest,
                ':ex5' => $assess->armCurl,
                ':ex6' => $assess->chairStand,
                ':dateC' => $assess->dateCreated));
            echo "New PhysicalAssessment added successfully<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
        $this->connection = null;
    }

    public function addMedicalForm($medForm)
    {
        $userID = $this->getUserID($medForm->email);
        try {
            $this->connection = $this->connect();
            $stmt = $this->connection->prepare("INSERT INTO medicalForm (UserID, field1, field2, field3)"
                . " VALUES (:userID, :field1, :field2, :field3)");
            $stmt->execute(array(':userID' => $userID,
                                ':field1' => $medForm->field1,
                                ':field2' => $medForm->field2,
                                ':field3' => $medForm->field3));
            echo "New medicalForm record added successfully<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
        $this->connection = null;
    }

    public function authenticateUser($login)
    {
        // code to find a corresponding username+password in the user table needs to be added
        return true;
    }

    public function clearDB()
    {
        try {
            $this->connection = $this->connect();
            $sql = "DELETE FROM user";
            $this->connection->exec($sql);
            echo "User table successfully erased<br>\n";
            echo "Delete on cascade should have deleted corresponding user rows in other tables (do a manual check)<br>\n";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
        $this->connection = null;
    }

    private function getUserID($email)
    {
        echo "fetching user id<br>\n";
        try {
            $this->connection = $this->connect();
            $stmt = $this->connection->prepare("SELECT ID FROM user WHERE Email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            $val = $stmt->fetchColumn(0);
            return $val;

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "<br>\n";
        }
    }

}

