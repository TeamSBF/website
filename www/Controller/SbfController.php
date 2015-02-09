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
        $user = new UserModel($values);
        if ($user->validateData())
            $user->assignValues();
        SbfController::$db->addUser($user);
    }

    public function registerMedicalForm($values)
    {
        $medForm = new MedicalFormModel($values);
        if ($medForm->validateData())
            $medForm->assignValues();
        SbfController::$db->addMedicalForm($medForm);
    }

    public function registerAssessment($values)
    {
        $assess = new AssessmentModel($values);
        if ($assess->validateData())
            $assess->assignValues();
        SbfController::$db->addAssessment($assess);
    }

    public function updateUserAccount($values)
    {
        $user = new UserModel($values);
        if ($user->validateData())
            $user->assignValues();
        SbfController::$db->updateUser($user);
    }

    public function authenticateUser($values)
    {
        $login = new LoginModel($values);
        if ($login->validateData())
            $login->assignValues();
        return SbfController::$db->authenticateMember($login);
    }

    public function displayUserInfo()
    {

    }

}