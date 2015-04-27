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
        printr($data);
        $keys = array_keys($data);
        $values = array_values($data);
        // key prep for replace
        array_walk($keys, function (&$value, $key) {$value = "[-$value-]";});

        // replace the basic or easy stuff
        $partial = str_replace($keys, $values, $template);
        $partial = $this->parseLogic($partial, $keys, $values);
        return $partial;
    }

    private function parseLogic($partial, $keys, $values)
    {

    }

    public static function getPartial($partial)
    {
        if (!array_key_exists($partial, self::$partials)) {
            self::$partials[$partial] = require_once "/partials/$partial.php";
        }
        return self::$partials[$partial];
    }
}