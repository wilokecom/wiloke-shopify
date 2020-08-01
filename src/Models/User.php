<?php

namespace WilokeShopify\Models;

class User
{
    public static function isUserExists($username)
    {
        return username_exists($username);
    }
    
    public static function createUser($username, $password = '', $email = '')
    {
        if (empty($password)) {
            $password = wp_generate_password(10);
        }
        
        return wp_create_user($username, $password, $email);
    }
    
 
}
