<?php
spl_autoload_register('AutoLoader::QueryLoader');
spl_autoload_register('AutoLoader::ManagerLoader');

class AutoLoader
{
    private static $path = ['query' => "Queries/", 'managers' => "Managers/"];

    public static function QueryLoader($className)
    {
        include self::$path['query'] . $className . ".php";
    }
	
	public static function ManagerLoader($classsName)
	{
		require_once self::$path['managers'] . $className . ".php";
	}
}