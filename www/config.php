<?php
spl_autoload_register('AutoLoader::QueryLoader');

class AutoLoader
{
    private static $path = ['query' => "Queries/"];

    public static function QueryLoader($className)
    {
        include self::$path['query'] . $className . ".php";
    }
}