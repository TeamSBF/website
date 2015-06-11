<?php
require_once "config.php";
require_once "sessions.php";

// Restrict access to each page based on the user's access level
Pages::instance()->ConfirmAccess($user, $_SERVER['PHP_SELF']);
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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700|Bree+Serif' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <!--      for webshim -->
    <?php if(1==2){?><script src="js/mod.js"></script>
    <script src="js/webshim/minified/polyfiller.js"></script>
    <script> $.webshims.polyfill(); </script><?php }?>
    <!--      for webshim -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui-1.11.4/external/jquery/jquery.js"></script>
    <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
    <?php if($user && $user->AccessLevel > 1 && strstr($_SERVER['PHP_SELF'], "index")){?>
    <script src="js/tinymce/tinymce.min.js"></script>
    <?php } ?>
	<script>
        <?php if($user && $user->AccessLevel > 1 && strstr($_SERVER['PHP_SELF'], "index")){?>
        tinymce.init({
            selector: "textarea[id^='articleEditor']",
            plugins: [
                "save advlist autolink lists link image charmap preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste youtube"
            ],
            toolbar: "save | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image| youtube"
            });
        <?php } ?>
    	$(function() {
            $("#accordion").accordion({
                active:false,
                collapsible: true,
                heightStyle: "content"
            });
            $("#accordion2").accordion({
                active: false,
                collapsible: true,
                heightStyle: "content"
            });
            // Hover states on the static widgets
            $("#dialog-link, #icons li").hover(
                function () {
                    $(this).addClass("ui-state-hover");
                },
                function () {
                    $(this).removeClass("ui-state-hover");
                }
            );
        });
	</script>
    
    
</head>
<body>
  <header class="grid_12 alpha">
    <nav class="grid_12 alpha">
      <?=Pages::instance()->BuildMenu($user);?>
    </nav>
  </header>
    <div class="container">
	<div class="grid_<?=($user->isLoggedIn() ? 12 : 8);?> alpha">