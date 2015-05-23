<?php
ob_start();
spl_autoload_extensions(".php");
spl_autoload_register('AutoLoader::ClassLoader');

class AutoLoader
{
    private static $folders = [
        "Queries/",
        "Queries/QueryElements/",
        "Models/",
        "Managers/",
        "scripts/"
    ];

    public static function ClassLoader($className)
    {
        $found = false;
        foreach (self::$folders as $folder) {
            $path = $folder . $className . ".php";
            //echo $path . "\n";
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