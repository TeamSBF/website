<?php
/**
 * Created by PhpStorm.
 * User: Samy
 * Date: 2/7/2015
 * Time: 2:48 PM
 */

use DbModel\AssessmentModel;
use DbModel\MedicalFormModel;
use DbModel\LoginModel;
use DbModel\UserModel;

include 'C:\UniServerZ\www\SBF_Database\Model\UserModel.php';
include 'C:\UniServerZ\www\SBF_Database\Model\LoginModel.php';


class SbfController
{
    private static $db;
    // This class will change as the project progresses
    function __construct($db_instance)
    {
        SbfController::$db = $db_instance;
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

    }

    public function updateUserAccount()
    {

    }

    public function authenticateUser($values)
    {

    }

    public function displayUserInfo()
    {

    }

}