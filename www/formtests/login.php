<?php
require_once"header.php";
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 3/26/2015
 * Time: 9:01 PM
 */

$_POST['email'] = 'asd';
$_POST['password'] = 'asd';

//if(isset($_POST['regKey'])) && $_POST['regKey'] === $_SESSION['regKey'])
if(isset($_POST['email'], $_POST['password']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    try {

        $stmt = $conn->prepare("SELECT `id` FROM `users` WHERE `email`=:email AND `password`=:pass LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $_SESSION['id'] = $stmt->fetch(PDO::FETCH_ASSOC);
            header("Location: index.php");
        }
    }catch(PDOException $e)
    {
        echo "<pre>Login Failed: " . $e->getMessage() . "</pre>";
    }
}

//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
?>

<div>
    <div>Login</div>
    <div>
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <input type="hidden" name="key" value="<?=$_SESSION['regKey'];?>" />
            <div>
                <input type="text" name="email" placeholder="Email Address" value="<?=$_POST['email'];?>" />
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" value="<?=$_POST['password'];?>" />
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</div>

<?php require_once"footer.php";?>