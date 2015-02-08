<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:46 PM
 */

namespace DbModel;


class MedicalFormModel extends BaseTableModel
{

    private $email;
    private $field1;
    private $field2;
    private $field3;
    private $dateCreated;

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
        $this->field1 = $this->vals["field1"];
        $this->field2 = $this->vals["field2"];
        $this->field3 = $this->vals["field3"];
    }
}