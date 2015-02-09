<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:45 PM
 */

namespace DbModel;
include(__DIR__.'\BaseTableModel.php');


class UserModel implements BaseTableModel
{
    private $email;
    private $lastName;
    private $firstName;
    private $userName;
    private $gender;
    private $dob;
    private $dateCreated;
    private $lastUpdate;
    private $password;
    private $agreedTerms;

    private $vals;

    function __construct($values)
    {
        $this->vals = $values;
    }

    public function validateData()
    {
        // Needs to be implemented
        return true;
    }

    public function assignValues()
    {
        $this->email = $this->vals['email'];
        $this->lastName = $this->vals["lastName"];
        $this->firstName = $this->vals["firstName"];
        $this->userName = $this->vals["userName"];
        $this->gender = $this->vals["gender"];
        $this->dob = $this->vals["dob"];
        //$this->dateCreated = $this->vals["dateCreated"];
        //$this->lastUpdate = $this->vals["lastUpdated"];
        $this->password = $this->vals["password"];
        $this->agreedTerms = $this->vals["agreedTerms"];
    }

    public function __get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}