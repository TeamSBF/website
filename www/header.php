<?php 
	session_start(); 
	require_once ("config.php");
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
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
  <link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">	

    
    <script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	<script>
	$(function() {
		
		$( "#accordion" ).accordion();
		
		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
	</script>
    
    
</head>
<body>
  <header class="grid_12 alpha">
    <nav class="grid_12 alpha">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
		<li><a href="faq.php">FAQ</a></li>
          <li><a href="assessments.php">Assessments</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </nav>
  </header>
    <div class="container">
   <div class="grid_8 alpha">