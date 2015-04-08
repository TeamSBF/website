<?php

if (isset($_SESSION['user_id'])) 
{
	require_once('login/logout.php');
}
else
{
	require_once('login/login.php');
}

?>