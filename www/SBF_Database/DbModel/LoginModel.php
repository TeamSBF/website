<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 3:03 PM
 */

namespace DbModel;


class LoginModel extends BaseTableModel
{

    private $username; // can be username or email associated with the account
    private $password;
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
        $this->username = $this->vals["email"];
        $this->password = $this->vals["password"];
    }
}