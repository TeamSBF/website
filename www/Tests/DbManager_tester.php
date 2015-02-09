<?php
/**
 * Created by PhpStorm.
 * User: Sami Awwad
 *
 * Date: 2/1/2015
 * Time: 4:24 PM
 */

require __DIR__.'..\DbManager.php';
require __DIR__.'..\Controller\SbfController.php';

echo "Performing basic database testing on sbf_database...<br>\n";
echo "Instanciating a DB object...<br>\n";

$user1 = ['email' => 'user1@hotmail.com', 'lastName' => 'awwad', 'firstName' => 'sami', 'userName' => 'cooldude', 'gender' => '1', 'dob' => '1982/12/14'];
$user2 = ['email' => 'user2@hotmail.com', 'lastName' => 'watt', 'firstName' => 'dan', 'userName' => 'buttlicker', 'gender' => '0', 'dob' => '1985/12/12'];

$db_instance = new DbManager();
$c = new SbfController($db_instance);

echo "Clearing the DB of previous data...<br>\n";
$db_instance->clearDB();

echo "Adding a user row...<br>\n";
$c->registerUser($user1);

echo "Adding another user row...<br>\n";
$c->registerUser($user2);

/*
echo "Adding an assessment for second user previously added...<br>\n";
$db_instance->addAssessment("bla7", "ex1", "ex2", "ex3", "ex4", "ex5");
echo "Adding a medical form for second user...<br>\n";
$db_instance->addMedicalForm("bla7", "f1", "f2", "f3");
echo "Adding a third user...<br>\n";
$db_instance->addUser("user3", "user3", "user3", "user3", "user3", "user3");
echo "Query entire User table and display its content<br>\n";
$db_instance->retrieveUserTable();
echo "deleting third user and cascade should delete his medical and physical assessment forms as well (do a manual check)<br>\n";
$db_instance->deleteUser("user3");
*/