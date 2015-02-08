<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:45 PM
 */

namespace DbModel;


class UserModel extends BaseTableModel
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

    function __constructor($values)
    {
        $this->vals = $values;
        $this->assignValues();
    }

    public function validateData($values)
    {
        // Needs to be implemented
        // For now the dictionary "values" is passed directly to the constructor without data scrubbing
    }

    public function assignValues()
    {
        $this->email = $this->vals["email"];
        $this->lastName = $this->vals["lastName"];
        $this->firstName = $this->vals["firstName"];
        $this->userName = $this->vals["userName"];
        $this->gender = $this->vals["gender"];
        $this->dob = $this->vals["dob"];
        $this->dateCreated = $this->vals["dateCreated"];
        $this->lastUpdate = $this->vals["lastUpdated"];
        $this->password = $this->vals["password"];
        $this->agreedTerms = $this->vals["agreedTerms"];
    }
}