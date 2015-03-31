<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 3/26/2015
 * Time: 9:45 PM
 */

$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "sbfdatabase";

try
{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

unset($host,$user,$pass,$dbname);

function printr($array)
{
    echo"<pre>";
    if(!is_array($array))
        echo "Not an array";
    else
        print_r($array);
    echo"</pre>";
}

function isLoggedIn()
{
    //return $_SESSION['id'] != 0;
    return @$_SESSION['id'] != 0;
}