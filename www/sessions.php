<?php
require_once"config.php";
$session = new SecureSessionHandler('cheese');
ini_set('session.save_handler','files');
session_set_save_handler($session,true);
session_save_path(__DIR__ . "/../sessions");

$session->start();
if(!$session->isValid()) {
$session->forget();
}

$user = $session->get('user');