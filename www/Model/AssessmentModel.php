<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:46 PM
 */

namespace DbModel;


class AssessmentModel implements BaseTableModel
{

    private $email;
    private $functionalReach;
    private $balanceTest;
    private $footUp;
    private $stepTest;
    private $armCurl;
    private $chairStand;
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
        $this->functionalReach = $this->vals["functionalReach"];
        $this->balanceTest = $this->vals["balanceTest"];
        $this->footUp = $this->vals["footUp"];
        $this->stepTest = $this->vals["stepTest"];
        $this->armCurl = $this->vals["armCurl"];
        $this->chairStand = $this->vals["chairStand"];
        $this->dateCreated = $this->vals["dateCreated"];
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