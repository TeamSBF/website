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
        // the unused brackets
        $brackets = '\[\[(.*?)\]\]';
        // attribute with quote
        $attribute = '[\"a-z=]*';
        // optional starting space
        $startSpace = '\s?';
        // optional ending quote
        $endQuote = '\"?';
        return preg_replace('/'.$startSpace.$attribute.$brackets.$endQuote.'/', "", $partial);
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
            $path = "partials/";
            $filename = "$partial.php";
            
            $file = $path.$filename;
            if(!file_exists($file))
                $file = $path."formelements/".$filename;
            
            self::$partials[$partial] = require_once $file;
        }
        return self::$partials[$partial];
    }
}