<?php
namespace WilokeShopify\Helpers;

class Name
{
    public static function autoAddPrefix($name)
    {
        $name   = trim($name);
        $prefix = App::get('configs/app')['prefix'];
        
        return strpos($name, $prefix) === 0 ? $name : $prefix.$name;
    }
}
