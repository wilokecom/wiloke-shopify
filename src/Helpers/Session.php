<?php
namespace WilokeShopify\Helpers;

class Session
{
    protected static $expiration = 900;
    
    public static function generatePrefix($name)
    {
        return 'wiloke-'.trim($name);
    }
    
    public static function sessionStart($sessionID = null)
    {
        global $pagenow;
        if ($pagenow == 'site-health.php' || (is_admin() && isset($_GET['page']) && $_GET['page'] == 'site-health')) {
            session_id($sessionID);
        }
        
        if (!headers_sent() && (session_status() == PHP_SESSION_NONE || session_status() === 1)) {
            session_start();
        }
    }
    
    public static function getSessionID()
    {
        session_start();
        var_export(session_id());
    }
    
    public static function setSession($name, $value, $sessionID = null)
    {
        if (empty(session_id())) {
            self::sessionStart($sessionID);
        }
        $_SESSION[self::generatePrefix($name)] = $value;
    }
    
    public static function destroySession($name = '')
    {
        if (empty($name)) {
            session_destroy();
        }
        
        unset($_SESSION[$name]);
    }
    
    public static function getSession($name, $thenDestroy = false)
    {
        self::sessionStart(self::generatePrefix($name));
        $value = isset($_SESSION[self::generatePrefix($name)]) ? $_SESSION[self::generatePrefix($name)] : '';
        
        if (empty($value)) {
            return false;
        }
        
        if ($thenDestroy) {
            self::destroySession($name);
        }
        
        return maybe_unserialize($value);
    }
}
