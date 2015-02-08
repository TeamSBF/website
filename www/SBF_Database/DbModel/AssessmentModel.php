<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:46 PM
 */

namespace DbModel;


class AssessmentModel extends BaseTableModel
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
        $this->functionalReach = $this->vals["functionalReach"];
        $this->balanceTest = $this->vals["balanceTest"];
        $this->footUp = $this->vals["footUp"];
        $this->stepTest = $this->vals["stepTest"];
        $this->armCurl = $this->vals["armCurl"];
        $this->chairStand = $this->vals["chairStand"];
        $this->dateCreated = $this->vals["dateCreated"];
    }
}