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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700|Bree+Serif' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <!--      for webshim -->
    <script src="assets/mod.js"></script>
    <script src="assets/webshim/minified/polyfiller.js"></script>
    <script> $.webshims.polyfill(); </script>
    <!--      for webshim -->
    <script src="js/jquery-ui-1.11.4/external/jquery/jquery.js"></script>
    <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
    <?php if($user && $user->AccessLevel > 1 && strstr($_SERVER['PHP_SELF'], "index")){?>
    <script src="js/tinymce/tinymce.min.js"></script>
    <?php } ?>
	<script>
        <?php if($user && $user->AccessLevel > 1 && strstr($_SERVER['PHP_SELF'], "index")){?>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste youtube"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image| youtube",
            setup: function(ed) {
                ed.addMenuItem('example',{
                   text: "My Menu Item",
                    context: "tools",
                    onclick: function()
                    {
                        ed.insertContent("hello world");
                    }
                });
            }
        });
        <?php } ?>
    	$(function() {
            $("#accordion").accordion({
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
      <?php NavMenu::Build($user);?>
    </nav>
  </header>
    <div class="container">
	<div class="grid_<?=$grid;?> alpha">