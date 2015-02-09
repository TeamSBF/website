<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 3:03 PM
 */

namespace DbModel;


class LoginModel implements BaseTableModel
{

    private $username; // can be username or email associated with the account
    private $password;
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
        $this->username = $this->vals["email"];
        $this->password = $this->vals["password"];
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