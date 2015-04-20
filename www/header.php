<?php
require_once "config.php";
require_once "sessions.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
  <title>Sit and Be Fit Research</title>
  
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/grid.css">	
  <link href='http://fonts.googleapis.com/css?family=Bitter|Bree+Serif' rel='stylesheet' type='text/css'>			
  <link rel="stylesheet" href="css/styles.css">	
	
</head>
<body>
  <header class="grid_12 alpha">
    <nav class="grid_12 alpha">
      <ul>
        <li><a href="index.php">Home</a></li>
        <?php if(!$user){?>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
		<li><a href="faq.php">FAQ</a></li>
        <li><a href="assessments.php">Assessments</a></li>
        <li><a href="register.php">Register</a></li>
        <?php }else{
            if($user->HasPrivilege(10)) echo '<li><a href="admin.php">Admin</a>\n';?>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>
    </nav>
  </header>
    <div class="container">
    <div class="grid_8 alpha">