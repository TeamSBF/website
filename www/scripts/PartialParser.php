<?php
class PartialParser extends Singleton
{
    private static $partials = [];

    public static function Parse($partial, $data)
    {
        $template = self::getPartial($partial);
        return self::instance()->parseTemplate($template, $data);
    }

    private function parseTemplate($template, $data)
    {
        // convert keys to template keys
        $data = $this->convertKeys($data);
        // replace the templated values with the actual values
        $partial = str_replace(array_keys($data), array_values($data), $template);
        // replace anything else that wasn't used with an empty string
        return preg_replace('/(\s*)\[\[(.*?)\]\](\s*)/', "", $partial);
    }
    
    private function convertKeys($data)
    {
        $converted = array();
        $keys = array_keys($data);
        foreach($keys as $key)
            $converted["[[".$key."]]"] = $data[$key];
        
        return $converted;
    }

    public static function getPartial($partial)
    {
        if (!array_key_exists($partial, self::$partials)) {
            self::$partials[$partial] = require_once "/partials/$partial.php";
        }
        return self::$partials[$partial];
    }
}