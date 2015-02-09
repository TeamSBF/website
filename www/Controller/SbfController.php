<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:48 PM
 */
set_include_path('./');

include(__DIR__.'\..\Model\UserModel.php');
include(__DIR__.'\..\Model\LoginModel.php');
include(__DIR__.'\..\DbManager.php');

use DbModel\AssessmentModel;
use DbModel\MedicalFormModel;
use DbModel\LoginModel;
use DbModel\UserModel;


class SbfController
{
    private static $db;
    // This class will change as the project progresses
    function __construct()
    {
        SbfController::$db = new DbManager();
    }

    public function registerUser($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $user = new UserModel($values);
        SbfController::$db->addUser($user);
    }

    public function loginUser($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $login = new LoginModel($values);
        SbfController::$db->authenticateUser($login);
    }

    public function registerMedicalForm($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $medForm = new MedicalFormModel($values);
        SbfController::$db->addMedicalForm($medForm);
    }

    public function registerAssessment($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $assess = new AssessmentModel($values);
        SbfController::$db->addAssessment($assess);
    }

    public function updateUserAccount($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $user = new UserModel($values);
        SbfController::$db->updateUser($user);
    }

    public function authenticateUser($values)
    {
        // Once data validation in the Model classes is in place, this method will call validateData
        // on the user object and call assignValues upon success
        $login = new LoginModel($values);
        SbfController::$db->authenticateMember($login);
    }

    public function displayUserInfo()
    {

    }

}