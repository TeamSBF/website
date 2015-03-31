<?php
require_once "header.php";
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 3/26/2015
 * Time: 9:33 PM
 */

//if(isset($_POST['regKey'])) && $_POST['regKey'] === $_SESSION['regKey'])
if(isset($_POST['email'], $_POST['password']))
{
    // attempted bypass of the below form
    if(!isset($_POST['email'], $_POST['password'], $_POST['confirmEmail'], $_POST['confirmPassword']))
    {
        $err = "All fields are required";
    }
    else
    {
        $email = $_POST['email'];
        $cemail = $_POST['confirmEmail'];
        $pass = $_POST['password'];
        $cpass = $_POST['confirmPassword'];

        if(md5($email) !== md5($cemail))
            $err = "Email addresses do not match";
        else if(md5($pass) !== md5($cpass))
            $err = "Passwords do not match";
        else
        {
            try {
                $stmt = $conn->prepare("SELECT `id` FROM `users` WHERE `email` = :email LIMIT 1");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                if ($stmt->rowCount() > 0)
                    $err = "That email address is already in use";
                else {
                    $stmt = $conn->prepare("INSERT INTO `users` (`email`,`password`,`created`)" .
                        "VALUES(:email, :pass, UNIX_TIMESTAMP())");
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':pass', $pass);
                    $stmt->execute();
                    if ($stmt->rowCount() < 1)
                        $err = "Failed to create the account. Something went wrong";
                    else
                        echo "You have been successfully registered into the database";
                }
            }
            catch(PDOException $e)
            {
                echo "<pre>PDO Error: " . $e->getMessage() . "</pre>";
            }
        }
    }
}
else
    $_POST['email'] = $_POST['confirmEmail'] = '';

//$_SESSION['regKey'] = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
?>
    <div>
        <div>Register</div>
        <?php
        if(isset($err))
        {
            echo"<div>" . $err . "</div>";
        }
        ?>
        <div>
            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="key" value="<?=$_SESSION['regKey'];?>" />
                <div>
                    Email Address <input type="text" name="email" value="<?=$_POST['email'];?>" required />
                </div>
                <div>
                    Confirm Email Address <input type="text" name="confirmEmail" value="<?=$_POST['confirmEmail'];?>"  />
                </div>
                <div>An activation email will be sent to the above address</div>
                <div>
                    Password <input type="password" name="password" required />
                </div>
                <div>
                    Confirm Password <input type="password" name="confirmPassword"  />
                </div>
                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
<?php require_once "footer.php";?>