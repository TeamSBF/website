<?php
require_once "config.php";
require_once "sessions.php";

$grid = ($user) ? 12 : 8;
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
  <link href='http://fonts.googleapis.com/css?family=Bitter:400,700|Bree+Serif' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
  <link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">	

    
    <script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	<script>
/*	$(function() {
		
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
	*/
	</script>
    
    
</head>
<body>
  <header class="grid_12 alpha">
    <nav class="grid_12 alpha">
      <?php NavMenu::Build($user);?>
    </nav>
  </header>
    <div class="container">
	<div class="grid_<?=$grid;?> alpha">