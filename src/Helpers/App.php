<?php

namespace WilokeShopify\Helpers;

class App
{
    private static $aRegistry = [];
    
    public static function bind($name, $value)
    {
        self::$aRegistry[$name] = $value;
    }
    
    public static function get($name)
    {
        return array_key_exists($name, self::$aRegistry) ? self::$aRegistry[$name] : false;
    }
}
