<?php

namespace WilokeShopify\Illuminate\Request;

use WilokeShopify\Helpers\App;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public static function getRoute()
    {
        foreach (App::get('configs/special-router') as $route => $conditional) {
            if (is_array($conditional)) {
                $aKeys   = array_keys($_GET);
                $aCommon = array_intersect($aKeys, $conditional);
                if (count($aCommon) === count($conditional)) {
                    return $route;
                }
            } else {
                if (isset($_GET[$route])) {
                    return $route;
                }
            }
        }
        
        return isset($_REQUEST['route']) && !empty($_REQUEST['route']) ? $_REQUEST['route'] : '';
    }
    
    public function getParams()
    {
        return self::method() === 'GET' ? $_GET : $_POST;
    }
    
    public function getParam($field)
    {
        $aParams = $this->getParams();
        
        return isset($aParams[$field]) ? $aParams[$field] : '';
    }
}
