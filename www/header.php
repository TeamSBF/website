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
  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#accordion').find('.accordion-toggle').click(function(){
	
				//Expand or collapse this panel
				$(this).next().slideToggle('fast');
	
				//Hide the other panels
				$(".accordion-content").not($(this).next()).slideUp('fast');
	
			});
		});
	</script>
  <link rel="stylesheet" href="css/styles.css">	

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