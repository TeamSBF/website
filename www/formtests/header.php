<?php
require_once"config.php";
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 3/26/2015
 * Time: 8:20 PM
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Sit and Be Fit</title>
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/forms.css" />
    <link rel="stylesheet" href="styles/jquery-ui.css" />
    <script src="js/external/jquery/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body>
<div> <a href="index.php">Home</a> |
<?php
//if($_SESSION['id'] != 0)
if(isLoggedIn())
    echo '<a href="logout.php">Logout</a>';
else
   echo '<a href="register.php">Register</a> | <a href="login.php">Login</a>';
?>
</div>