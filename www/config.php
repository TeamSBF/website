<?php
ob_start();
spl_autoload_extensions(".php");
spl_autoload_register('AutoLoader::ClassLoader');

class AutoLoader
{
    private static $folders = ["Queries/",
        "Queries/QueryElements/",
        "Models/",
        "Managers/"];

    public static function ClassLoader($className)
    {
        $found = false;
        foreach (self::$folders as $folder) {
            $path = $folder . $className . ".php";
            if (file_exists($path)) {
                require_once($path);
                $found = true;
                break;
            }
        }
        if (!$found)
            throw new Exception("Failed to find '" . $className . "' in any of the listed directories.");
    }
}

function printr($arr)
{
	echo"<pre>". print_r($arr, true) . "</pre>";
}

$session = new SessionManager('cheese');
ini_set('session.save_handler','files');
session_set_save_handler($session,true);
session_save_path(__DIR__ . "/../sessions");

$session->start();
if(!$session->isValid(5)) {
    echo "session timed out";
    $session->destroy();
}

$session->put('hello.world','bonjour');
echo $session->get('hello.world');