<?php
/*spl_autoload_register('AutoLoader::QueryLoader');
spl_autoload_register('AutoLoader::ManagerLoader');
spl_autoload_register('AutoLoader::DefaultLoader');

class AutoLoader
{
    private static $path = ['query' => "Queries/", 'managers' => "Managers/", 'default' => "/"];

    public static function QueryLoader($className)
    {
        @include_once self::$path['query'] . $className . ".php";
    }
	
	public static function ManagerLoader($className)
	{
		@include_once self::$path['managers'] . $className . ".php";
	}

    public static function DefaultLoader($className)
    {
        @include_once self::$path['default'] . $className . ".php";
    }
}*/