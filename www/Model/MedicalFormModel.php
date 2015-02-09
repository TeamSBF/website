<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:46 PM
 */

namespace DbModel;


class MedicalFormModel implements BaseTableModel
{

    private $email;
    private $field1;
    private $field2;
    private $field3;
    private $dateCreated;

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
        $this->email = $this->vals["email"];
        $this->field1 = $this->vals["field1"];
        $this->field2 = $this->vals["field2"];
        $this->field3 = $this->vals["field3"];
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