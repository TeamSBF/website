<?php
require_once"config.php";
require_once"sessions.php";
$session->forget();
header("location: index.php");
