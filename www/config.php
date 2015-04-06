<?php
spl_autoload_extensions(".php");
spl_autoload_register('AutoLoader::QueryLoader');
spl_autoload_register('AutoLoader::QueryElementLoader');
spl_autoload_register('AutoLoader::ModelLoader');
spl_autoload_register('AutoLoader::ManagerLoader');

class AutoLoader
{
    private static $path = ['queries' => "Queries/",
                            'queryElements' => "Queries/QueryElements/",
                            'models' => "Models/",
                            'managers' => "Managers/"];

    public static function QueryLoader($className)
    {
        @include_once self::$path['queries'] . $className . ".php";
    }

    public static function QueryElementLoader($className)
    {
        @include_once self::$path['queryElements'] . $className .".php";
    }

    public static function ModelLoader($className)
    {
        @include_once self::$path['models'] . $className . ".php";
    }
	
	public static function ManagerLoader($className)
	{
		@include_once self::$path['managers'] . $className . ".php";
	}
}