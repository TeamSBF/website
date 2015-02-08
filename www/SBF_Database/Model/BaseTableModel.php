<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 7:01 PM
 */

namespace DbModel;

interface BaseTableModel
{
    public function assignValues();
    public function validateData($values);
    public function __get($property);
    public function __set($property, $value);
}